<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\Auth\LoginTokenMail;
use App\Models\Notification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('home');
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::user();

            if ($user->isWait()) {
                Auth::logout();

                return $this->sendUnverifiedEmailResponse();
            }

            Auth::logout();

//            $token = (string)random_int(10000, 99999);
            $token = "0000";
            $request->session()->put('auth', [
                'id' => $user->id,
                'token' => $token,
                'remember' => $request->filled('remember'),
            ]);
            Mail::to($user->email)->send(new LoginTokenMail($user, $token));

            Notification::generate([
                'user_id' => $user->id,
                'title' => 'Новый вход в аккаунт',
                'content' => 'Выполнен вход в аккаунт в ' . Carbon::now()->format('H:i')
            ]);

            return [
                'success' => true,
                'nextRoute' => route('login.verify')
            ];
            return $this->sendLoginResponse($request);

        }

        $this->incrementLoginAttempts($request);

        return [
            'success' => false,
            'message' => 'Неправильный логин и/или пароль'
        ];
        return $this->sendFailedLoginResponse($request);
    }

    public function verify(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return [
                'success' => false,
                'message' => 'Слишком много попыток входа'
            ];
            $this->sendLockoutResponse($request);
        }

        $this->validate($request, [
            'token' => 'required|string',
        ]);

        if (!$session = $request->session()->get('auth')) {
            return [
                'success' => false,
                'message' => 'Отсутствует код подтверждения. Попробуйте позже.'
            ];
            throw new BadRequestHttpException('Отсутствует код подтверждения. Попробуйте позже..');
        }

        $user = User::findOrFail($session['id']);

        if ($request['token'] === $session['token']) {
            $request->session()->flush();
            $this->clearLoginAttempts($request);

            Auth::login($user, $session['remember']);

            Notification::generate([
                'user_id' => $user->id,
                'title' => 'Новый вход в аккаунт',
                'content' => 'Выполнен вход в аккаунт в ' . Carbon::now()->format('H:i')
            ]);

            return [
                'success' => true,
                'forwardTo' => Redirect::intended()->getTargetUrl()
            ];
            return redirect()->intended(route('profile.index'));
        }

        $this->incrementLoginAttempts($request);

        return [
            'success' => false,
            'message' => 'Неверный код подтверждения'
        ];
    }

    protected function sendLoginResponse(Request $request)
    {

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return new JsonResponse([], 204);
    }

    public function sendUnverifiedEmailResponse() {
        return response(['message' => 'Пожалуйста подвердите свою почту перед входом.'], 403);
    }
}

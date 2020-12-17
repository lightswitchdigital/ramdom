<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Providers\RouteServiceProvider;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('home');
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

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

            Notification::generate([
                'user_id' => $user->id,
                'title' => 'Новый вход в аккаунт',
                'content' => 'Выполнен вход в аккаунт в ' . Carbon::now()->format('H:i')
            ]);

            return $this->sendLoginResponse($request);

        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request) {

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return new JsonResponse([], 204);
    }

    public function sendUnverifiedEmailResponse() {
        return response(['message' => 'Пожалуйста подвердите свою почту перед входом.'], 403);
    }
}

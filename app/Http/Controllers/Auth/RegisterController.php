<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UsersService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $service;
    protected $redirectTo;

    public function __construct(UsersService $service)
    {
        $this->middleware('guest');

        $this->redirectTo = route('login');
        $this->service = $service;
    }

    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $this->service->register($request);

        return new JsonResponse([], 204);
    }
}

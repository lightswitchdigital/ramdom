<?php

namespace App\Services;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class UsersService
{
    public function register(RegisterRequest $request) {

        $user = User::register($request['name'], $request['last_name'], $request['email'], $request['phone'], $request['role'], $request['type'], $request['password']);

        return $user;
    }

    public function sendVerificationEmail(User $user) {

    }
}

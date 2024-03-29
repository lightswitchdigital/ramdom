<?php

namespace App\Services;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class UsersService
{
    public function register(RegisterRequest $request) {

        $user = User::register($request['name'], $request['last_name'], $request['email'], $request['phone'], $request['role'], $request['type'], $request['password']);

        return $user;
    }

    public function create(CreateRequest $request) {
        $user = User::create([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'middle_name' => $request['middle_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => $request['role'],
            'type' => $request['type'],
            'status' => $request['status'],
            'password' => bcrypt($request['password'])
        ]);

        return $user;
    }

    public function sendVerificationEmail(User $user) {

    }
}

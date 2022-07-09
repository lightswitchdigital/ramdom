<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', Rule::in(array_keys(User::rolesList()))],
            'type' => ['required', 'string', Rule::in(array_keys(User::typesList()))],
            'status' => ['required', 'string', Rule::in(array_keys(User::statusesList()))],
            'password' => ['required', 'string', 'min:8']
        ];
    }
}

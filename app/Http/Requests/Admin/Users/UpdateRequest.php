<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = Auth::user();

        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', Rule::in(array_keys(User::adminRolesList()))],
            'type' => ['required', 'string', Rule::in(array_keys(User::typesList()))],
            'status' => ['required', 'string', Rule::in(array_keys(User::statusesList()))],
            'password' => ['nullable', 'string', 'min:8']
        ];
    }
}

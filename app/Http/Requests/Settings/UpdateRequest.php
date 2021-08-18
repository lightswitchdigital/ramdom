<?php

namespace App\Http\Requests\Settings;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];

        $rules = $user->isIndividual() ? array_merge($rules, [
            'passport_serial' => ['nullable', 'numeric', 'digits:4'],
            'passport_code' => ['nullable', 'numeric', 'digits:6'],
            'passport_issue' => ['nullable', 'string', 'max:255'],
            'passport_issue_date' => ['nullable', 'date'],
        ]) : array_merge($rules, [
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string'],
            'company_inn' => ['required', 'string', 'max:255'],
            'company_account' => ['required', 'string', 'max:255'],
        ]);

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndividualInformationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'passport_serial' => ['nullable', 'numeric', 'digits:4'],
            'passport_code' => ['nullable', 'numeric', 'digits:6'],
            'passport_issue' => ['nullable', 'string', 'max:255'],
            'passport_issue_date' => ['nullable', 'date'],
        ];
    }
}

<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityInformationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string'],
            'company_inn' => ['required', 'string', 'max:255'],
            'company_account' => ['required', 'string', 'max:255'],
        ];
    }
}

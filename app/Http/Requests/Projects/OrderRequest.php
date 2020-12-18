<?php

namespace App\Http\Requests\Projects;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(User $user)
    {
        $params = [
            'order_name' => ['required', 'string', 'max:255'],
            'order_email' => ['required', 'string', 'max:255'],
            'order_phone' => ['required', 'string', 'max:255'],
            'order_city' => ['required', 'string', 'max:255'],
            'order_address' => ['required', 'string'],
            'order_postal_code' => ['required', 'numeric', 'digits:6'],
        ];

        if ($user->isIndividual()) {
            $params = array_merge($params, [
                'order_passport_serial' => ['required', 'numeric', 'digits:4'],
                'order_passport_number' => ['required', 'numeric', 'digits:6'],
                'order_passport_issue' => ['required', 'string', 'max:255'],
                'order_passport_issue_date' => ['required', 'string', 'max:255'],
            ]);
        }

        if ($user->isEntity()) {
            $params = array_merge($params, [
                'order_company_name' => ['required', 'string', 'max:255'],
                'order_company_address' => ['required', 'string'],
                'order_company_inn' => ['required', 'string', 'max:255'],
                'order_company_kpp' => ['required', 'string', 'max:255'],
                'order_company_payment_account' => ['required', 'string', 'max:255'],
                'order_company_correspondent_account' => ['required', 'string', 'max:255'],
            ]);
        }

        return $params;
    }
}

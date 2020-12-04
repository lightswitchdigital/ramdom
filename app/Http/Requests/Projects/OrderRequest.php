<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize()
    {
        return false;
    }


    public function rules()
    {
        return [
            //
        ];
    }
}

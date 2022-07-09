<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text' => ['nullable', 'string'],
            'price.*' => ['nullable', 'numeric'],
            'attrs.*.equals' => ['nullable', 'string'],
            'attrs.*.from' => ['nullable', 'numeric'],
            'attrs.*.to' => ['nullable', 'numeric'],
        ];
    }
}

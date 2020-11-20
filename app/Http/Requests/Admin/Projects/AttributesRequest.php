<?php

namespace App\Http\Requests\Admin\Projects;

use App\Models\Projects\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $items = [];

        foreach (Attribute::all() as $attribute) {
            $rules = [
                $attribute->required ? 'required' : 'nullable',
            ];
            if ($attribute->isInteger()) {
                $rules[] = 'integer';
            } elseif ($attribute->isFloat()) {
                $rules[] = 'numeric';
            } else {
                $rules[] = 'string';
                $rules[] = 'max:255';
            }
            if ($attribute->isSelect()) {
                $rules[] = Rule::in($attribute->variants);
            }
            $items['attribute.' . $attribute->id] = $rules;
        }

        return $items;
    }
}

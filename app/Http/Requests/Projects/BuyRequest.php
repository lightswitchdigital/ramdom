<?php

namespace App\Http\Requests\Projects;

use App\Models\Projects\Purchase\PurchaseAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $items = [];

        foreach (PurchaseAttribute::all() as $attribute) {
            $rules = [
                'required',
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
            $items['purchase_attributes.' . $attribute->id] = $rules;
        }

        return $items;
    }
}

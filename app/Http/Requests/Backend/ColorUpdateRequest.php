<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['string', 'max:50', 'unique:colors,nombre'],
            'slut' => ['string', 'max:50'],
            'hexa' => ['string', 'max:6', 'unique:colors,hexa'],
            'rgb' => ['string', 'max:20'],
            'metadata' => ['json'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductInfo extends FormRequest
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
            'name'        => 'required|max:255',
            'barcode'     => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'quantity'    => 'required|integer|min:0',
            'unit_price'  => 'required|integer|min:0',
        ];
    }
}

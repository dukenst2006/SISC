<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //        return $this->user()->can('updateCompany');
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
            'name'      => 'required|max:255',
            'address'   => 'required|max:255',
            'city'      => 'required|max:60',
            'postcode'  => 'required|max:20',
            'country'   => 'required|max:100',
            'vat'       => 'required|max:12',
            'email'     => 'required|max:254',
            'telephone' => 'required|max:25',
            'mobile'    => 'max:25',
        ];
    }
}

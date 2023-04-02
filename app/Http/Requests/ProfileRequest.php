<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address.required' => 'Lütfen adresinizi girin.',
            'city.required' => 'Lütfen şehri seçin.',
            'state.required' => 'Lütfen ilçeyi seçin.',
            'mobile.required' => 'Lütfen cep telefonunuzu girin.',
            'mobile.unique' => 'Girmiş olduğunu cep telefonu sistemimizde kayıtlı.',
            'invoice_address.required' => 'Lütfen fatura adresinizi girin.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'invoice_address' => 'required|string'
        ];
    }
}

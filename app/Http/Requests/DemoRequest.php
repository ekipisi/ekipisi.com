<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemoRequest extends FormRequest
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
            'firstname.required' => 'Lütfen adınızı girin.',
            'lastname.required' => 'Lütfen soyadınızı girin.',
            'email.required' => 'Lütfen e-posta adresinizi girin.',
            'phone.required' => 'Lütfen telefon numaranızı girin.'
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
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|min:7|max:20'
        ];
    }
}

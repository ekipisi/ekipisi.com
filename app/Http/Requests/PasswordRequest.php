<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current.required' => 'Lütfen parolanızı girin.',
            'password.required' => 'Lütfen parolanızı girin.',
            'password.confirmed' => 'Lütfen parolanızın tekrarını doğru girdiğinizden emin olun.'
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
            'current' => 'required|string',
            'password' => 'required|string|min:4|confirmed'
        ];
    }
}

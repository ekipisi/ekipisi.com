<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnershipRequest extends FormRequest
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
            'firstname.required' => 'Lütfen referansınızın adını girin.',
            'lastname.required' => 'Lütfen referansınızın soyadını girin.',
            'email.required' => 'Lütfen referansınızın e-posta adresini girin.',
            'email.unique' => 'Girmeye çalıştığınız referans daha önce sistemimize kaydedildi.',
            'phone.required' => 'Lütfen referansınızın telefon numarasını girin.',
            'phone.unique' => 'Girmeye çalıştığınız referans daha önce sistemimize kaydedildi.',
            'company.required' => 'Lütfen referasınızın firmasının adını girin.'
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
            'email' => 'required|email|max:100|unique:partnerships',
            'phone' => 'required|string|max:30|unique:partnerships',
            'company' => 'required|string|max:150'
        ];
    }
}

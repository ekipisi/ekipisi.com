<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingPaymentRequest extends FormRequest
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
            'cardnumber.required' => 'Lütfen Kredi Kartı Numarasını girin.',
            'cardnumber.ccn' => 'Kredi Kartı Numarası geçersiz',
            'name.required' => 'Lütfen Kartın Üzerindeki İsmi girin.',
            'expiry-month.required' => 'Lütfen Son Kullanma Ayı girin.',
            'expiry-month.max' => 'Lütfen Geçerli Son Kullanma Ayı girin.',
            'expiry-year.required' => 'Lütfen Son Kullanma Yılı girin.',
            'expiry-year.max' => 'Lütfen Geçerli Son Kullanma Yılı girin.',
            'cvc.unique' => 'Lütfen CVC numarasını girin.',
            'cvc.cvc' => 'CVC numarası geçersiz.'
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
            'cardnumber' => 'required|ccn',
            'name' => 'required|string|max:30',
            'expiry-month' => 'required|int',
            'expiry-year' => 'required|int',
            'cvc' => 'required|cvc'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title.required' => 'Lütfen mesajınızı girin.',
            'message.required' => 'Lütfen mesajınızı girin.',
            'department.required' => 'Lütfen departman seçin.',
            'priority.required' => 'Lütfen önceliği seçin.',
            'fielduploader.mimes' => 'Sadece resim dosyası gönderebilirsiniz.',
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
            'title' => 'required|string|min:2',
            'message' => 'required|string|min:2',
            'department' => 'required',
            'priority' => 'required',
            'fielduploader.*' => 'mimes:jpg,jpeg,png'
        ];
    }
}

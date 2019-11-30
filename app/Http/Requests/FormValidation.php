<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormValidation extends FormRequest
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
            'a_name' => "required|max:50",
            'a_phone' => "required|max:50",
           // 'g-recaptcha-response' => 'required|captcha'
        ];
    }
    public function messages()
    {
        return [
            'a_name.required' => "Name field is required",
            'a_name.max' =>'Not more than 50',
            'a_phone.required' => "Phone field is required"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'min:8',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => "Обов'язкове поле",
//            'email.unique' => 'Користувач з такою E-mail адресою існує',
            'password.min' => 'Пароль повинен містити не менше 8 символів',
        ];
    }
}

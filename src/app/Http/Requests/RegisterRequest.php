<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => ':attributeを入力して下さい',
            'email.required' => ':attributeを入力して下さい',
            'password.required' => ':attributeを入力して下さい',
            'password.min' => ':attributeは:min文字以上で入力して下さい',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'お名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}

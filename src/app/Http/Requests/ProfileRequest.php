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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => 'required',
            'profile_image' => 'required|mimes:jpg,png|mimetypes:image/jpeg,image/png',
            'postal_code' => 'required|regex:/\A\d{3}\-\d{4}\z/',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => ':attributeを入力して下さい',
            'profile_image.required' => ':attributeを入力して下さい',
            'profile_image.mimes' => ':attributeには、:valuesタイプのファイルを入力してください',
            'profile_image.mimetypes' => ':attributeには、:valuesタイプのファイルを指定してください',
            'postal_code.required' => ':attributeを入力して下さい',
            'postal_code.regex' => ':attributeには、ハイフンありの8文字で入力してください。',
            'address.required' => ':attributeを入力して下さい',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'お名前',
            'profile_image' => 'プロフィール画像',
            'postal_code' => '郵便番号',
            'address' => '住所',
        ];
    }
}

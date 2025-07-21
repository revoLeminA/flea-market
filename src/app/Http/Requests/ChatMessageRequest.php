<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatMessageRequest extends FormRequest
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
            'message' => 'required|max:400',
            'image' => 'mimes:jpg,png|mimetypes:image/jpeg,image/png',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => ':attributeを入力して下さい',
            'message.max' => ':attributeは:max文字以内で入力してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.mimetypes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }

    public function attributes()
    {
        return [
            'message' => '本文',
        ];
    }
}

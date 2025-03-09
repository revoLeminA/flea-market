<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'item_name' => 'required',
            'description' => 'required|max:255',
            'item_image' => 'required|mimes:jpg,png|mimetypes:image/jpeg,image/png',
            'categories' => 'required',
            'status' => 'required',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'item_name.required' => ':attributeを入力して下さい',
            'description.required' => ':attributeを入力して下さい',
            'description.max' => ':attributeは:max文字以内で入力してください',
            'item_image.required' => ':attributeを入力して下さい',
            'item_image.mimes' => ':attributeには、:valuesタイプのファイルを入力してください',
            'item_image.mimetypes' => ':attributeには、:valuesタイプのファイルを指定してください',
            'categories.required' => ':attributeを入力して下さい',
            'status.required' => ':attributeを入力して下さい',
            'price.integer' => ':attributeは整数値で入力して下さい',
            'price.min' => ':attributeは:min円以上で入力して下さい',
        ];
    }

    public function attributes()
    {
        return [
            'item_name' => '商品名',
            'description' => '商品説明',
            'item_image' => '商品画像',
            'categories' => '商品のカテゴリー',
            'status' => '商品の状態',
            'price' => '商品価格',
        ];
    }
}

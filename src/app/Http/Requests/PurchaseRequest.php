<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ProfileRequest;

class PurchaseRequest extends FormRequest
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
            'payment_method' => 'required',
            'shipping_postal_code' => 'required',
            'shipping_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'payment_method.required' => ':attributeを入力して下さい',
            'shipping_postal_code.required' => ':attributeを入力して下さい',
            'shipping_address.required' => ':attributeを入力して下さい',
        ];
    }

    public function attributes()
    {
        return [
            'payment_method' => '支払方法',
            'shipping_postal_code' => '配送先郵便番号',
            'shipping_address' => '配送先住所',
        ];
    }
}

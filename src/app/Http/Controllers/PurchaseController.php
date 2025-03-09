<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // 商品購入画面
    public function purchase()
    {
        return view('purchase');
    }

    // 送付先住所変更画面
    public function address()
    {
        return view('address');
    }
}

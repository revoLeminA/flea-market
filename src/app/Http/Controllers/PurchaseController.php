<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use Stripe\Stripe;

class PurchaseController extends Controller
{
    // 商品購入画面
    public function purchase($item_id)
    {
        $user = Auth::user();
        $item = Item::where('id', $item_id)->first();

        return view('purchase', compact('user', 'item'));
    }

    // 商品購入処理
    public function create($item_id, PurchaseRequest $request, Purchase $purchase_data)
    {
        $user = Auth::user();
        $data = $request->all();

        $purchase_data->purchaseStore($user->id, $item_id, $data);

        // 商品のステータスを「売却済み」に更新
        Item::where('id', $item_id)->first()->update(['is_sold' => 1]);
        Item::where('id', $item_id)->first()->touch();

        return redirect('/mypage?tab=buy');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Item;

class SellController extends Controller
{
    // 商品出品画面
    public function sell()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('sell', compact('categories', 'user'));
    }

    // 商品出品画面
    public function create(ItemRequest $request, Item $item_data)
    {
        $user = Auth::user();
        $data = $request->all();

        $dir = 'images';
        $file_name = $request->file('item_image')->getClientOriginalname();
        $request->file('item_image')->storeAs('public/' . $dir, $file_name);

        $item_data->itemStore($user->id, $data, $dir, $file_name);

        // 中間テーブルの同期
        Item::find($item_data->id)->categories()->sync($data['categories']);

        return redirect('/mypage?tab=sell');
    }
}

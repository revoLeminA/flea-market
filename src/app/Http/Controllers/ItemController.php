<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    //商品詳細画面
    public function item($item_id)
    {
        $item = Item::where('id', $item_id)->first();
        return view('item', compact('item'));
    }
}

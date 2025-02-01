<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\ItemRequest;

class SellController extends Controller
{
    //商品出品画面
    public function sell()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('sell', compact('categories', 'user'));
    }

    //商品出品画面
    public function create(ItemRequest $request)
    {
        $dir = 'images';
        $file_name = $request->file('item_image')->getClientOriginalname();
        $request->file('item_image')->storeAs('public/' . $dir, $file_name);

        $item_data = new Item();
        $item_data->user_id = $request->user_id;
        $item_data->item_name = $request->item_name;
        $item_data->description = $request->description;
        $item_data->price = $request->price;
        $item_data->status = $request->status;
        $item_data->item_image = 'storage/' . $dir . '/' . $file_name;
        $item_data->is_sold = FALSE;
        $item_data->save();

        return redirect('/sell');
    }
}

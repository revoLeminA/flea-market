<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SellController extends Controller
{
    //商品出品画面
    public function sell()
    {
        $categories = Category::all();
        return view('sell', compact('categories'));
    }

    //商品出品画面
    public function create()
    {
        $dir = 'images';
        $file_name = $request->file('profile_image')->getClientOriginalname();
        $request->file('profile_image')->storeAs('public/' . $dir, $file_name);

        $profile_data = Auth::user();
        $profile_data->user_name = $request->user_name;
        $profile_data->profile_image = 'storage/' . $dir . '/' . $file_name;
        $profile_data->postal_code = $request->postal_code;
        $profile_data->address = $request->address;
        $profile_data->building = $request->building;
        $profile_data->save();

        return redirect('/sell');
    }
}

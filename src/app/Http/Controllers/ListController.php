<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Item;

class ListController extends Controller
{
    //初期ページへ
    public function index()
    {
        $user = Auth::user();
        if(is_null($user->address)){
            return redirect('/mypage/profile');
        }
        else{
            return redirect('/');
        }
    }

    // 商品リスト一覧画面
    public function list()
    {
        $items = Item::all();
        return view('list', compact('items'));
    }

    // マイリスト一覧画面
    public function mylist()
    {
        $items = Item::find([1,2,3,]);
        return view('list', compact('items'));
    }

    //商品詳細画面
    public function detail()
    {
        return view('item');
    }

    //商品購入画面
    public function purchase()
    {
        return view('purchase');
    }

    //送付先住所変更画面
    public function address()
    {
        return view('address');
    }
}

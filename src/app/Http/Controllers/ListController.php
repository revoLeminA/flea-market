<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Item;

class ListController extends Controller
{
    //初期ページへ
    public function home()
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
}

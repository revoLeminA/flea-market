<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Item;
use App\Models\Purchase;

class MypageController extends Controller
{
    // プロフィール画面
    public function mypage(Request $request)
    {
        $user = Auth::user();

        $isSellItem = FALSE;
        $isBuyItem = FALSE;
        if ($request->tab == 'sell') {
            $items = Item::where('user_id', '=', $user->id)->get();
            $isSellItem = TRUE;
        }
        elseif ($request->tab == 'buy') {
            $purchases = Purchase::where('user_id', '=', $user->id)->get();
            $items = [];
            if (!empty($purchases->toArray())) {
                $items = Item::find($purchases->id)->get();
            }
            $isBuyItem = TRUE;
        }
        else {
            // dd('error');
            // 赤いバーとかでエラー表示させる
        }
        
        return view('mypage', compact('user','items', 'isSellItem', 'isBuyItem'));
    }
}

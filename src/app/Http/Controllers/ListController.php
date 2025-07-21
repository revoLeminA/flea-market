<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Like;

class ListController extends Controller
{
    // 初期ページへ
    public function home()
    {
        $user = Auth::user();

        // 認証ユーザかつプロフィール未設定チェック
        if(isset($user) && is_null($user->address)){
            return redirect('/mypage/profile');
        }
        else{
            return redirect('/');
        }
    }

    // 商品リスト一覧画面
    public function list(Request $request, Item $items)
    {
        $user = Auth::user();
        $isMyList = FALSE;

        // 認証ユーザ
        if (isset($user)) {
            // 検索条件を保持
            if (isset($request->keyword) && $request->keyword !== '') {
                $items = Item::where('user_id', '!=', $user->id)->KeywordSearch($request->keyword)->get(); // 自分が出品した商品は表示しない
            }
            else {
                $items = Item::where('user_id', '!=', $user->id)->get(); // 自分が出品した商品は表示しない
            }
            // マイリスト（ユーザがいいねした商品のみ表示）
            if ($request->tab == 'mylist') {
                $likes = [];
                foreach ($items as $item) {
                    if (Like::where('item_id', $item->id)->where('user_id', $user->id)->exists()) {
                        // ユーザがいいねした商品を取得
                        $likes[] = Like::where('item_id', $item->id)->where('user_id', $user->id)->first();
                    }
                }
                $itemsMyList = array();
                foreach ($likes as $like) {
                    array_push($itemsMyList, $items->where('id', $like->item_id)->first());
                }
                $items = $itemsMyList;
                $isMyList = TRUE;
            }
        }
        // 未認証ユーザ
        else {
            $items = Item::all();
            // マイリスト（未認証ユーザはいいねできないため何も表示しない）
            if ($request->tab == 'mylist') {
                $items = null;
                $isMyList = TRUE;
            }
        }

        return view('list', compact('items', 'isMyList'));
    }

    // 検索
    public function search(Request $request)
    {
        $user = Auth::user();
        $items = Item::KeywordSearch($request->keyword)->get(); // キーワードと一致する商品を取得
        $isMyList = $request->is_mylist;

        // 認証ユーザ
        if (isset($user)) {
            $items = $items->where('user_id', '!=', $user->id); // 自分が出品した商品は表示しない
            // マイリスト（ユーザがいいねした商品のみ表示）
            if ($isMyList) {
                $likes = Like::where('user_id', $user->id)->get();
                $itemsMyList = array();
                foreach ($likes as $like) {
                    // キーワードと一致、自分が出品していない、自分がいいねしたのすべての条件を満たした商品のみ取得
                    if ($items->where('id', $like->item_id)->first() != null) {
                        array_push($itemsMyList, $items->where('id', $like->item_id)->first());
                    }
                }
                $items = $itemsMyList;
            }
        }
        // 未認証ユーザ
        else {
            if ($isMyList) {
                $items = null;
            }
        }

        return view('list', compact('items', 'isMyList'));
    }
}

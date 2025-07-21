<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AddressController extends Controller
{
    // 送付先住所変更画面
    public function address($item_id)
    {
        $user = Auth::user();

        return view('address', compact('user', 'item_id'));
    }

    // 送付先住所変更処理
    public function upload($item_id, Request $request, User $user)
    {
        $addressData = $request->all();

        $user = Auth::user();
        $user->addressUpload($addressData);

        return redirect()->route('purchase.create', ['item_id' => $item_id]);
    }
}

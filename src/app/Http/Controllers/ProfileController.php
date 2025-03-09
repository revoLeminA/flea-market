<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    // プロフィール編集画面（設定画面）
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // プロフィール更新
    public function upload(ProfileRequest $request)
    {
        $data = $request->all();

        $dir = 'images';
        $file_name = $request->file('profile_image')->getClientOriginalname();
        $request->file('profile_image')->storeAs('public/' . $dir, $file_name);

        $profile_data = Auth::user();
        $profile_data->profileUpload($data, $dir, $file_name);

        return redirect('/mypage?tab=sell');
    }
}

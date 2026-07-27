<?php

namespace App\Http\Controllers;

use App\Models\Product;   
use Illuminate\Http\Request;

class MypageController extends Controller
{
public function index(Request $request)
{
    $user = auth()->user();
    $page = $request->query('page', 'profile');

    if ($user->is_first_login) {
        return redirect()->route('mypage.profile.first');
    }

    // ▼ 商品一覧の取得だけ行う（return しない）
    if ($page === 'sell') {
        $products = Product::where('seller_id', $user->id)->latest()->get();
    } elseif ($page === 'buy') {
        $products = Product::where('buyer_id', $user->id)->latest()->get();
    } else {
        $products = [];
    }

    // ▼ 最後に必ず1回だけ view を返す
    return view('mypage.index', compact('user', 'page', 'products'));
}


public function edit()
{
    $user = auth()->user();
    return view('mypage.profile', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    // プロフィール更新処理（画像や名前の更新など）
    // ここはあなたの処理のままでOK

    // ★ 初回ログインフラグをオフにする
    if ($user->is_first_login) {
        $user->is_first_login = false;
        $user->save();
    }

    $user->save();

    // ★ プロフィール設定完了後はトップへ
    return redirect()->route('top');
}

public function first()
{
    $user = auth()->user();
    return view('mypage.profile_first', compact('user'));
}


}

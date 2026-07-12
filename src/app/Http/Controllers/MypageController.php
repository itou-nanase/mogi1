<?php

namespace App\Http\Controllers;

use App\Models\Product;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページ（閲覧）
    public function index(Request $request)
    {
        $user = auth()->user();
        $page = $request->query('page', 'profile');

    // 初回ログインならプロフィール設定へ
        if ($user->is_first_login) {
            return redirect()->route('mypage.profile.first');
        }

    // ▼ 出品した商品タブ
        if ($page === 'sell') {
            $products = Product::where('seller_id', $user->id)->latest()->get();
            return view('mypage.index', compact('user', 'page', 'products'));
        }

    // ▼ 購入した商品タブ
        if ($page === 'buy') {
            $products = Product::where('buyer_id', $user->id)->latest()->get();
            return view('mypage.index', compact('user', 'page', 'products'));
        }

    // ▼ プロフィールタブ
        return view('mypage.index', compact('user', 'page'));
    }

    // プロフィール編集画面
    public function edit()
    {
        $user = auth()->user();
        return view('mypage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // バリデーション
        $request->validate([
            'username' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // 画像アップロード
        if ($request->hasFile   ('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        }

        // その他の項目更新
        $user->username = $request->username;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;

        // 🔥 初回ログインフラグを OFF にする（ここ！）
        if ($user->is_first_login) {
            $user->is_first_login = false;
        }
        
        $user->save();

        return redirect()->route('mypage')->with('success', 'プロフィールを更新しました');
    }


    public function selling()
    {
        $user = auth()->user();
        // 自分が出品した商品だけ取得
        $products = Product::where('seller_id', $user->id)->latest()->get();

        return view('mypage.selling', compact('user', 'products'));
    }

    public function purchased()
    {
        $user = auth()->user();
        $products = $user->purchasedProducts()->latest()->get();
        return view('mypage.profile', compact('user', 'products'));
    }
}


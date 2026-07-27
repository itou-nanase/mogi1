<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $keyword = $request->input('keyword');

        $recommendedProducts = Product::query()
            ->when($userId, function ($query, $userId) {
            // 自分が出品した商品を除外
            $query->where('seller_id', '!=', $userId);
            })
            ->when($keyword, function ($query, $keyword) {
            // キーワード検索
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->with('buyer')
            ->get();
        
        // ★ ここで空の likedProducts を渡しておく
        $likedProducts = collect();

        return view('top', compact('recommendedProducts', 'likedProducts','keyword'));
    }


    public function mylist()
    {
        $user = auth()->user();

        // ユーザーが「いいね」した商品だけ取得
        $likedProducts = $user->likes()->with('product')->get()->pluck('product');

        // ★ おすすめ用の空データ
        $recommendedProducts = collect();

        return view('top', compact('likedProducts', 'recommendedProducts'));
    }

    public function show($item_id)
    {
       $product = Product::with([
        'brand',
        'categories',
        'condition',
        'comments.user',
        'likes'
        ])
        ->withCount(['likes', 'comments'])
        ->findOrFail($item_id);

        return view('product_detail', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $recommendedProducts = Product::query()
            ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();

        // ★ マイリスト用の空データ
        $likedProducts = collect();

        return view('top', compact('recommendedProducts', 'likedProducts', 'keyword'));
    }
}

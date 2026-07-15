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

        $products = Product::query()
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

        return view('top', compact('products', 'keyword'));
    }


    public function mylist()
    {
        $user = auth()->user();

        // ユーザーが「いいね」した商品だけ取得
        $products = $user->likes()->with('product')->get()->pluck('product');

        return view('top', compact('products'));
    }

    public function show($item_id)
    {
       $product = Product::with([
        'brand',
        'category',
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

        $products = Product::query()
            ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();

        return view('top', compact('products', 'keyword'));
    }
}

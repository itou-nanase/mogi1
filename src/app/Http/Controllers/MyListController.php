<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class MyListController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->likes()->with('product');

        if ($request->filled('keyword')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        // ★ ここを products → likedProducts に変更
        $likedProducts = $query->get()->pluck('product');

        // ★ おすすめ用の空データも渡す（top.blade が参照するため）
        $recommendedProducts = collect();

        return view('top', compact('likedProducts', 'recommendedProducts'));
    }
}

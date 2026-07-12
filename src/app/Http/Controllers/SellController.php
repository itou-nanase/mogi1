<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SellController extends Controller
{
    public function index()
    {
        return view('sell.index', [
            'categories' => self::CATEGORIES,
            'conditions' => self::CONDITIONS,
        ]);
    }

public function store(Request $request)
{
    // バリデーション（結果を $validated に入れる）
    $validated = $request->validate([
        'product_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'categories'    => 'required|array',
        'condition'     => 'required|string',
        'name'          => 'required|string|max:255',
        'brand'         => 'nullable|string|max:255',
        'description'   => 'required|string',
        'price'         => 'required|integer|min:1',
    ]);

    // 画像保存
    $path = $request->file('product_image')->store('products', 'public');

    // DB 保存
    Product::create([
        'image_path' => $path,
        'categories' => json_encode($validated['categories']),
        'condition'  => $validated['condition'],
        'name'       => $validated['name'],
        'brand'      => $validated['brand'],
        'description'=> $validated['description'],
        'price'      => $validated['price'],
        'seller_id'  => auth()->id(),
    ]);

    return redirect()->route('mypage', ['page' => 'sell']);
}

        public const CATEGORIES = [
            'ファッション',
            '家電',
            'インテリア',
            'レディース',
            'メンズ',
            'コスメ',
            '本',
            'ゲーム',
            'スポーツ',
            'キッチン',
            'ハンドメイド',
            'アクセサリー',
            'おもちゃ',
            'ベビー・キッズ',
        ];

        public const CONDITIONS = [
            '良好',
            '目立った傷や汚れなし',
            'やや傷や汚れあり',
            '状態が悪い',
    ];
}



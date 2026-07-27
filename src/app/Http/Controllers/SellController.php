<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Condition;
use App\Http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function index()
    {
        return view('sell.index', [
            'categories' => Category::all(),
            'conditions' => Condition::all(),
        ]);
    }

    public function store(ExhibitionRequest $request)
    {
        // バリデーション済み
        $validated = $request->validated();

        // 画像保存
        $path = $request->file('product_image')->store('products', 'public');

        // ブランド名 → brand_id を作成または取得
        $brandId = null;
        if (!empty($validated['brand'])) {
            $brandId = Brand::firstOrCreate([
                'name' => $validated['brand'],
            ])->id;
        }

        // 商品作成（カテゴリは後で attach）
        $product = Product::create([
            'image_path'   => $path,
            'condition_id' => $validated['condition'],
            'name'         => $validated['name'],
            'brand_id'     => $brandId,
            'description'  => $validated['description'],
            'price'        => $validated['price'],
            'seller_id'    => auth()->id(),
        ]);

        // カテゴリ複数選択
        // $validated['categories'] は配列（例: [1,3,5]）
        $product->categories()->attach($validated['categories']);

        return redirect()->route('mypage', ['page' => 'sell']);
    }
}

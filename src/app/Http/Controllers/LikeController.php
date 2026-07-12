<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Product $product)
    {
        $user = auth()->user();

        // すでにいいねしているか？
        $like = $product->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // いいね解除
            $like->delete();
        } else {
            // いいね登録
            $product->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return back();
    }
}


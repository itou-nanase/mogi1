<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function start(Product $product)
    {
        $user = auth()->user(); // ログインユーザー

        return view('purchase.start', [
        'product' => $product,
        'user' => $user,]);
    }

    public function confirm(Request $request,Product $product)
    {
        $payment = $request->payment_method; // ← ここで取得できる

        // 購入処理
        $product->buyer_id = auth()->id();
        $product->save();

        return view('purchase.complete', [
            'product' => $product,
            'payment' => $payment,
        ]);
    }

    public function checkout(Product $product)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price, // ← 金額（円）
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['product' => $product->id]),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Product $product)
    {
        $product->buyer_id = auth()->id();
        $product->save();

        return redirect()->route('top');
    }

    public function editAddress(Product $product)
    {
        $user = auth()->user();
        return view('purchase.address', compact('product', 'user'));
    }

    public function updateAddress(Request $request, Product $product)
    {
        $request->validate([
        'address' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->address = $request->address;
        $user->save();

        // 住所更新後、購入画面に戻す
        return redirect()->route('purchase.start', $product->id)
                     ->with('success', '住所を更新しました');
    }


}

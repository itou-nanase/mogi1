@extends('layouts.layout')

@section('header-buttons')
    {{-- 検索バー --}}
    <form action="{{ route('products.search') }}" method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="検索" />
        <button type="submit">検索</button>
    </form>

    {{-- ログアウト --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn">ログアウト</button>
    </form>

    {{-- マイページ --}}
    <a href="{{ route('mypage') }}" class="mypage-btn">マイページ</a>
@endsection

@section('title', '購入手続き')

@section('css')
<link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('content')
<div class="purchase-wrapper">
    {{-- 左 2/3 --}}
    <div class="purchase-left">
    {{-- 商品情報 --}}
    <div class="product-info">
        <img src="{{ asset('storage/' . $product->image_path) }}" class="purchase-product-image">

        <h2 class="product-name">{{ $product->name }}</h2>

        <p class="product-price">
            ¥{{ number_format($product->price) }}
        </p>
    </div>

    {{-- 購入確定ボタン --}}
    <form action="{{ route('stripe.checkout', $product->id) }}" method="POST">
    @csrf

        {{-- 支払方法 --}}
        <div class="payment-box">
            <h3>支払方法</h3>
            <select name="payment_method" class="payment-select">
            <option value="convenience">コンビニ払い</option>
            <option value="card">カード払い</option>
            </select>
        </div>

        {{-- 住所 --}}
        <div class="address-box">
            <h3>配送先</h3>
            <p class="address-text">{{ $user->address }}</p>
            <a href="{{ route('purchase.address.edit', $product->id) }}" class="address-edit">住所を変更する</a>
        </div>
    </div>

    {{-- 右 1/3 --}}
    <div class="purchase-right">
        <h3>注文内容</h3>

        <p>商品代金：<strong>¥{{ number_format($product->price) }}</strong></p>

        <p>支払方法：  
            <span id="selected-payment">コンビニ払い</span>
        </p>

        <button type="submit" class="purchase-btn">購入を確定する</button>
    </div>
    </form>

</div>

@endsection

@extends('layouts.layout')

@section('header-buttons')
    {{-- 検索バー --}}
    <form method="GET" action="{{ route('top.search') }}">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
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

@section('title', 'プロフィール設定')

@section('css')
<link rel="stylesheet" href="/css/mypage.css">
@endsection

@section('content')

{{-- ▼ プロフィール情報 --}}

<div class="profile-header">
    <img src="{{ asset('storage/' . $user->profile_image) }}" class="profile-image">
    <h2>{{ $user->name }}</h2>
    <a href="{{ route('mypage.edit') }}" class="edit-profile-btn">
    プロフィールを編集
    </a>
</div>


<div class="tab-menu">
    <a href="/mypage?page=sell" class="{{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>
    <a href="/mypage?page=buy" class="{{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
</div>

{{-- ▼ 出品した商品 --}}
@if ($page === 'sell')
<div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                <img src="{{ asset('storage/' . $product->image_path) }}"class="product-image">
                <p>{{ $product->name }}</p>
            </a>
        </div>
    @endforeach
</div>
@endif

{{-- ▼ 購入した商品 --}}
@if ($page === 'buy')
<div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                <img src="{{ asset('storage/' . $product->image_path) }}"class="product-image">
                <p>{{ $product->name }}</p>
            </a>
        </div>
    @endforeach
</div>
@endif
@endsection

@extends('layouts.layout')

@section('header-buttons')
    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">ログアウト</button>
    </form>

    <form action="{{ url()->current() }}" method="GET" class="search-form">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
        <button type="submit">検索</button>
    </form>
    @endauth
@endsection

@section('title', 'マイリスト')

@section('css')
<link rel="stylesheet" href="/css/top.css">
@endsection

@section('content')

<div class="tab-menu">
    <a href="{{ route('top') }}" 
       class="tab {{ request()->routeIs('top') ? 'active' : '' }}">
        おすすめ
    </a>

    <a href="{{ route('mylist') }}" 
       class="tab {{ request()->routeIs('mylist') ? 'active' : '' }}">
        マイリスト
    </a>
</div>

<div class="product-grid">
    @foreach ($products as $product)
        @if ($product->user_id !== optional(auth()->user())->id)
            <div class="product-card">
                <div class="image-wrapper">
                    <img src="{{  asset('storage/' . $product->image_path)}}" alt="{{ $product->name }}">

                    @if ($product->is_sold)
                        <span class="sold-badge">SOLD</span>
                    @endif
                </div>

                <p class="product-name">{{ $product->name }}</p>
            </div>
        @endif
    @endforeach
</div>

@endsection

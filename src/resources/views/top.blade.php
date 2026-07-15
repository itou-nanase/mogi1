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

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="/css/top.css">
@endsection

@section('content')

<div class="tab-menu">
    <a href="{{ route('top') }}" 
       class="tab {{ request()->routeIs('top') ? 'active' : '' }}">
        おすすめ
    </a>

    <a href="{{ route('mylist',['keyword' => request('keyword')]) }}" 
       class="tab {{ request()->routeIs('mylist') ? 'active' : '' }}">
        マイリスト
    </a>
</div>

<div class="product-grid">
    @foreach ($products as $product)
        @if ($product->seller_id !== optional(auth()->user())->id)
            <div class="product-card">
                <div class="image-wrapper">
                    <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                        <img src="{{  asset('storage/' . $product->image_path)}}" alt="{{ $product->name }}">

                        @if ($product->is_sold)
                            <span class="sold-badge">SOLD</span>
                        @endif

                        <p>{{ $product->name }}</p>
                    </a>
                    @if ($product->is_sold)
                        <span class="sold-badge">SOLD</span>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
</div>

@endsection

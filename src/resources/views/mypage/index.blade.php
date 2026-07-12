@extends('layouts.layout')

@section('title', 'プロフィール')

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

@section('css')
<link rel="stylesheet" href="/css/mypage.css">
@endsection

@section('content')

{{-- ▼ プロフィール情報 --}}
<div class="profile-header">
    <div class="profile-left">
        <img src="{{ asset('storage/' . $user->profile_image) }}" class="profile-image">
    </div>

    <div class="profile-right">
        <h2 class="profile-name">{{ $user->name }}</h2>        
    </div>
    
    {{-- ▼ プロフィール編集ボタン --}}
    <div class="profile-edit">
        <label class="edit-profile-label" onclick="window.location.href='{{ route('mypage.edit') }}'">
        プロフィールを編集
        </label>
    </div>
</div>

<div class="tab-menu">
 
    <a href="/mypage?page=sell" class="tab {{ request()->query('page') === 'sell' ? 'active' : '' }}">
        出品した商品
    </a>

    <a href="{{ route('mypage', ['page' => 'buy']) }}"
       class="tab {{ request()->routeIs('mypage.purchased') ? 'active' : '' }}">
        購入した商品
    </a>
</div>

{{-- ▼ 商品一覧（page=sell のときだけ表示） --}}
@if ($page === 'sell')
<div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card">
            <div class="image-wrapper">
                <a href="{{ route('item.show', ['item_id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">

                    @if ($product->is_sold)
                        <span class="sold-badge">SOLD</span>
                    @endif

                    <p>{{ $product->name }}</p>
                </a>
            </div>
        </div>
    @endforeach
</div>
@endif
@endsection


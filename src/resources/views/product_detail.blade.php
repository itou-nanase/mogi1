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

@section('title', '商品詳細')

@section('css')
<link rel="stylesheet" href="/css/product_detail.css">
@endsection

@section('content')

<div class="product-detail-wrapper">

    {{-- 左：商品画像 --}}
    <div class="product-detail-left">
        <img src="{{ asset('storage/' . $product->image_path) }}" class="product-main-image">
    </div>

    {{-- 右：商品情報（ここにコメントフォームも入れる） --}}
    <div class="product-detail-right">

        <h1 class="product-name">{{ $product->name }}</h1>

        <p class="brand-name">ブランド：{{ $product->brand->name ?? '未設定' }}</p>

        <p class="price">¥{{ number_format($product->price) }}(税込)
        </p>

        <div class="icons">

    {{-- いいねボタン --}}
    <form action="{{ route('products.like', $product->id) }}" method="POST">
        @csrf

        <button type="submit" class="like-btn">
            @auth
                @if ($product->isLikedBy(auth()->user()))
                    💗 {{ $product->likes->count() }}  <!-- いいね済み -->
                @else
                    ♡{{ $product->likes->count() }}  <!-- 未いいね -->
                @endif
            @else
                ♡ {{$product->likes->count() }}     <!-- 未ログイン -->
            @endauth
        </button>
    </form>

    <span class="comment">💬 {{ $product->comments_count }}</span>
</div>


        <div class="purchase-button-wrapper">
            <a href="{{ route('purchase.start', $product->id) }}" class="purchase-button">
            購入手続きへ
            </a>
        </div>

        <div class="description">
            <h2>商品説明</h2>
            <p>{{ $product->description }}</p>
        </div>

        <div class="product-info">
            <h2>商品情報</h2>
            <ul>
                <li>カテゴリ：{{ $product->category->name ?? '未設定' }}</li>
                <li>商品の状態：{{ $product->condition->label ?? '未設定' }}</li>
            </ul>
        </div>

        {{-- コメント一覧 --}}
        @if ($product->comments->count() > 0)
        <div class="comment-list">

            @foreach ($product->comments as $comment)
                <div class="comment-item">

                    {{-- コメントしたユーザー情報 --}}
                <div class="comment-user">
                    <img src="{{ asset('storage/' . $comment->user->profile_image) }}" class="user-icon">
                    <span class="username">{{ $comment->user->name }}</span>
                </div>

                {{-- コメント内容 --}}
                <p class="comment-body">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
        @else
            <p>まだコメントはありません。</p>
        @endif

        {{-- ★ コメント入力欄を右カラムに入れる --}}
        @auth
        <div class="comment-form">
            <h3>商品へのコメント</h3>

            <form action="{{ route('comments.store', $product->id) }}" method="POST">
                @csrf
                <textarea name="body" rows="4" class="comment-textarea"
                    placeholder="コメントを入力してください">{{ old('body') }}</textarea>

                @error('body')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <button type="submit" class="comment-submit-btn">コメントを送信する</button>
            </form>
        </div>
        @endauth
        @guest
            <p style="margin-top:20px; color:#555;">
            コメントするには <a href="/login">ログイン</a> が必要です。
            </p>
        @endguest
    </div>
</div>


@endsection

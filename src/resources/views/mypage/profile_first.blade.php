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

@section('title', 'プロフィール設定')

@section('css')
<link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')
<div class="container">
    <h2>プロフィール設定</h2>

    <form method="POST" action="{{ route('mypage.update') }}">
        @csrf

    <div class="profile-container">
        <!-- プロフィール画像の表示部分 -->
        <div class="profile-image-wrapper">
        <img id="profilePreview" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '/images/default-user.png' }}">
        </div>

        <!-- 画像選択ボタン -->
        <div class="profile-actions">
            <label for="profile_image" class="upload-btn">画像を選択する</label>
            <input id="profile_image" type="file" name="profile_image" accept="image/*" style="display:none;">
        </div>
    </div>

        <label for="username">ユーザー名</label>
        <input id="username" type="text" name="username">
        @error('username')
            <p class="error">{{ $message }}</p>
        @enderror


        <label for="postal_code">郵便番号</label>
        <input id="postal_code" type="text" name="postal_code">
        @error('postal_code')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="address">住所</label>
        <input id="address" type="text" name="address">
        @error('address')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="building">建物名</label>
        <input id="building" type="text" name="building">
        @error('building')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">更新する</button>

    </form>
</div>
@endsection

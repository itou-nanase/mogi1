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


@section('title', '配送先住所の変更')

@section('css')
<link rel="stylesheet" href="/css/address.css">
@endsection

@section('content')
<div class="address-form">

    <h2>住所変更</h2>

    <form action="{{ route('address.update') }}" method="POST">
        @csrf

        {{-- 郵便番号 --}}
        <div class="form-group">
            <label for="postal_code">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code"
                   value="{{ old('postal_code', $user->postal_code ?? '') }}"
                   placeholder="例：123-4567">
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" id="address" name="address"
                   value="{{ old('address', $user->address ?? '') }}"
                   placeholder="例：東京都渋谷区〇〇1-2-3">
        </div>

        {{-- 建物名・部屋番号 --}}
        <div class="form-group">
            <label for="building">建物名・部屋番号</label>
            <input type="text" id="building" name="building"
                   value="{{ old('building', $user->building ?? '') }}"
                   placeholder="例：サンプルマンション101号室">
        </div>

        <button type="submit" class="address-submit-btn">更新する</button>
    </form>

</div>

@endsection

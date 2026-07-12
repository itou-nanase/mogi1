@extends('layouts.layout')

@section('title', 'プロフィール編集')

@section('css')
<link rel="stylesheet" href="/css/profile.css">
@endsection

@section('content')
<div class="container">

    <h2>プロフィール設定</h2>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('mypage.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- プロフィール画像 --}}
        <div class="profile-container">

            <div class="profile-image-wrapper">
                <img id="profilePreview"
                     src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '/images/default-user.png' }}">
            </div>

            <div class="profile-actions">
                <label for="profile_image" class="upload-btn">画像を選択する</label>
                <input id="profile_image" type="file" name="profile_image" accept="image/*" style="display:none;">
            </div>

        </div>

        {{-- ユーザー名 --}}
        <label for="username">ユーザー名</label>
        <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}">

        {{-- 郵便番号 --}}
        <label for="postal_code">郵便番号</label>
        <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">

        {{-- 住所 --}}
        <label for="address">住所</label>
        <input id="address" type="text" name="address" value="{{ old('address', $user->address) }}">

        {{-- 建物名 --}}
        <label for="building">建物名</label>
        <input id="building" type="text" name="building" value="{{ old('building', $user->building) }}">

        <button type="submit" class="update-btn">更新する</button>

    </form>
</div>
@endsection

@extends('layouts.layout')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')
<div class="container">
    <h2>会員登録</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">名前</label>
        <input id="name" type="text" name="name">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="password_confirmation">パスワード（確認）</label>
        <input id="password_confirmation" type="password" name="password_confirmation">
        
        <button type="submit">登録する</button>

        <a href="/login">ログインはこちら</a>
    </form>
</div>
@endsection

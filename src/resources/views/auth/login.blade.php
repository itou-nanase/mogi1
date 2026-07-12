@extends('layouts.layout')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')
<div class="container">

    <h2>ログイン</h2>

    <form method="POST" action="/login">
        @csrf

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

        <button type="submit">ログインする</button>

        <a href="/register">会員登録はこちら</a>
    </form>
</div>
@endsection

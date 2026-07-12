@extends('layouts.layout')

@section('title', 'メール認証')

@section('content')
<div class="container">
    <h2>認証メールを送信しました</h2>

    <p>登録したメールアドレスに認証リンクを送信しました。</p>
    <p>メール内のリンクをクリックして認証を完了してください。</p>

    <a href="{{ route('verification.verify', ['id' => auth()->id(), 'hash' => sha1(auth()->user()->email)]) }}"
       class="btn">
        メール認証はこちら
    </a>

    <form method="POST" action="{{ route('verification.send') }}" style="margin-top:20px;">
        @csrf
        <button type="submit" class="btn-secondary">メールを再送する</button>
    </form>
</div>
@endsection

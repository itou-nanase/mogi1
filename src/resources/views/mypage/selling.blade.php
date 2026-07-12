@extends('layouts.layout')

@section('title', '出品した商品')

@section('content')
<h2>出品した商品</h2>

<div class="product-list">
    @foreach ($products as $product)
        <div class="product-item">
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像">
            <p>{{ $product->name }}</p>
            <p>{{ $product->price }}円</p>
        </div>
    @endforeach
</div>
@endsection

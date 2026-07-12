@extends('layouts.layout')

@section('title', '商品を出品する')

@section('css')
<link rel="stylesheet" href="/css/sell.css">
@endsection

@section('content')
<div class="sell-container">

<form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h2 class="page-title">商品を出品する</h2>

    {{-- ▼ 商品画像アップロード欄（form の中に入れる） --}}
    <div class="image-section">
        <h3 class="sub-title">商品画像</h3>

        <label for="product_image" class="image-upload-btn">
            画像を選択する
        </label>

        <input id="product_image" type="file" name="product_image" accept="image/*" style="display:none;">

        <img id="preview" src="" alt="" class="preview-image" style="display:none;">
    </div>

    {{-- ▼ カテゴリ --}}
    <label>カテゴリ（複数選択可）</label>
    <div class="category-tags">
        @foreach($categories as $category)
            <label class="tag">
                <input type="checkbox" name="categories[]" value="{{ $category }}" class="tag-input">
                <span class="tag-label">{{ $category }}</span>
            </label>
        @endforeach
    </div>

    {{-- ▼ 商品の状態 --}}
    <label>商品の状態</label>
    <select name="condition">
        @foreach($conditions as $condition)
            <option value="{{ $condition }}">{{ $condition }}</option>
        @endforeach
    </select>

    {{-- ▼ 商品名 --}}
    <label>商品名</label>
    <input type="text" name="name">

    {{-- ▼ ブランド名 --}}
    <label>ブランド名</label>
    <input type="text" name="brand">

    {{-- ▼ 商品説明 --}}
    <label>商品説明</label>
    <textarea name="description"></textarea>

    {{-- ▼ 販売価格 --}}
    <label>販売価格</label>
    <input type="number" name="price">

    <button type="submit" class="sell-submit">出品する</button>
</form>


</div>

{{-- ▼ JS：画像プレビュー --}}
<script>
document.getElementById('product_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
});
</script>

@endsection

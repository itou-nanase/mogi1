<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadeAuth;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\SellController;


// GET /register（新規登録画面）
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

// GET /login（ログイン画面）
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// POST /login（ログイン処理）
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest'])
    ->name('login.store');

//ログアウト
Route::post('/logout', function () {
    FacadeAuth::logout();
    return redirect('/login');
})->middleware('auth')->name('logout');

// プロフィール画面
Route::get('/mypage', [MypageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage'); // 閲覧画面

// 初回ログイン時だけ表示するプロフィール設定画面
Route::get('/mypage/profile/first', [MypageController::class, 'first'])
    ->name('mypage.profile.first');

// 通常のプロフィール編集画面
Route::get('/mypage/profile', [MypageController::class, 'edit'])
    ->name('mypage.edit');

// 更新処理
Route::post('/mypage/profile/update', [MypageController::class, 'update'])
    ->name('mypage.update');

// 出品した商品一覧
Route::get('/mypage/sell', [MypageController::class, 'selling'])->name('mypage.selling');

// 購入した商品一覧
Route::get('/mypage/purchased', [MypageController::class, 'purchased'])->name('mypage.purchased');


//検索バー
Route::get('/search', [TopController::class, 'search'])->name('top.search');

// トップ画面（未認証でも閲覧可）
Route::get('/', [TopController::class, 'index'])
    ->name('top');

Route::get('/', [TopController::class, 'index'])->name('top');

Route::get('/products', [TopController::class, 'index'])->name('products.index');

//マイリスト
Route::get('/mylist', [TopController::class, 'mylist'])
    ->middleware('auth')
    ->name('mylist');

Route::get('/products/mylist', [MyListController::class, 'index'])
    ->name('products.mylist');

//商品詳細
Route::get('/item/{item_id}', [TopController::class, 'show'])->name('item.show');

//コメント
Route::post('/products/{product}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

//購入手続きへ
Route::get('/purchase/{product}', [PurchaseController::class, 'start'])
    ->middleware('auth')
    ->name('purchase.start');

//購入確定ボタン
Route::post('/purchase/{product}/confirm', [PurchaseController::class, 'confirm'])
    ->middleware('auth')
    ->name('purchase.confirm');

Route::post('/products/{product}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('products.like');

//STRIPE
Route::post('/checkout/{product}', [PurchaseController::class, 'checkout'])
    ->name('stripe.checkout');

Route::get('/checkout/success/{product}', [PurchaseController::class, 'success'])
    ->name('stripe.success');

Route::get('/checkout/cancel', [PurchaseController::class, 'cancel'])
    ->name('stripe.cancel');

//住所変更画面
Route::get('/purchase/address/{product}', [PurchaseController::class, 'editAddress'])
    ->middleware('auth')
    ->name('purchase.address.edit');

Route::post('/address/update', [AddressController::class, 'update'])->name('address.update');

//商品出品画面
Route::get('/sell', [SellController::class, 'index'])->name('sell');
Route::post('/sell', [SellController::class, 'store'])->name('sell.store');



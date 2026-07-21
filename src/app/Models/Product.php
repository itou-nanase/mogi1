<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'image_path',
        'categories',      // JSON
        'brand_id',        // 外部キー
        'category_id',     // 外部キー
        'condition_id',    // 外部キー
        'description',
        'price',
        'buyer_id',
        'address',
    ];

    // 出品者
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // 購入者
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // SOLD 判定
    public function getIsSoldAttribute()
    {
        return !is_null($this->buyer_id);
    }

    // いいね
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // ブランド
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // カテゴリ
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // コンディション
    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }

    // コメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

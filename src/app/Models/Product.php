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
        'categories',
        'condition',
        'brand',
        'description',
        'price',
        'buyer_id',
        'address', 
    ];

    // 出品者
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 購入者
        public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // 購入済み判定
    public function getIsSoldAttribute()
    {
        return !is_null($this->buyer_id);
    }
    //マイリスト
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    //商品詳細
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

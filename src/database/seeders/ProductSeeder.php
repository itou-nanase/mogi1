<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // ★ まずユーザーを作る（5人）
        $users = User::factory()->count(5)->create();
        
         // カテゴリ一覧を取得（id と name）
        $categories = Category::all();

        // ダミー商品データ
$items = [
    [
        'name' => '腕時計',
        'image_path' => 'products/Clock.jpg',
        'price' => 15000,
        'description' => '高級腕時計です。',
        'brand_id' => 1,
        'condition_id' => 1,
    ],
    [
        'name' => 'HDD',
        'image_path' => 'products/Disk.jpg',
        'price' => 5000,
        'description' => '1TBの外付けHDDです。',
        'brand_id' => 2,
        'condition_id' => 2,
    ],
    [
        'name' => '玉ねぎ3束',
        'image_path' => 'products/tamanegi.jpg',
        'price' => 300,
        'description' => '新鮮な玉ねぎ3束セット。',
        'brand_id' => 3,
        'condition_id' => 3,
    ],
    [
        'name' => '革靴',
        'image_path' => 'products/Shoes.jpg',
        'price' => 4000,
        'description' => 'ビジネス向けの革靴。',
        'brand_id' => 1,
        'condition_id' => 2,
    ],
    [
        'name' => 'ノートPC',
        'image_path' => 'products/Laptop.jpg',
        'price' => 45000,
        'description' => '高性能ノートPC。',
        'brand_id' => 2,
        'condition_id' => 1,
    ],
    [
        'name' => 'マイク',
        'image_path' => 'products/Mic.jpg',
        'price' => 8000,
        'description' => '高音質コンデンサーマイク。',
        'brand_id' => 3,
        'condition_id' => 1,
    ],
    [
        'name' => 'ショルダーバッグ',
        'image_path' => 'products/Bag.jpg',
        'price' => 3500,
        'description' => '使いやすいショルダーバッグ。',
        'brand_id' => 1,
        'condition_id' => 2,
    ],
    [
        'name' => 'タンブラー',
        'image_path' => 'products/Tumbler.jpg',
        'price' => 500,
        'description' => '保温・保冷対応タンブラー。',
        'brand_id' => 2,
        'condition_id' => 1,
    ],
    [
        'name' => 'コーヒーミル',
        'image_path' => 'products/Coffee+Grinder.jpg',
        'price' => 4000,
        'description' => '手挽きコーヒーミル。',
        'brand_id' => 3,
        'condition_id' => 2,
    ],
    [
        'name' => 'メイクセット',
        'image_path' => 'products/makeup.jpg',
        'price' => 2500,
        'description' => '初心者向けメイクセット。',
        'brand_id' => 1,
        'condition_id' => 1,
    ],
];

        foreach ($items as $item) {
            $product=Product::create([
                'name'       => $item['name'],
                'image_path' => $item['image_path'],
                'price'      => $item['price'], 
                'seller_id'  =>  $users->random()->id,
                'description' => $item['description'],
                'brand_id' => $item['brand_id'],
                'condition_id' => $item['condition_id'], 
                'buyer_id'   => null,                   // 未購入
            ]);

            // カテゴリをランダムに1つ付与
            $categoryId = $categories->random()->id;

            // 中間テーブルに登録
            $product->categories()->attach([$categoryId]);
        }
    }
}

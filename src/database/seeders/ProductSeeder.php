<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 出品者を作成
        $user = User::factory()->create([
            'email' => 'phoebe.hessel@example.net',
            'password' => bcrypt('password'),
        ]);

        // ランダム出品者用に複数ユーザー作成
        $users = User::factory()->count(3)->create();

        // ダミー商品データ
        $items = [
            ['name' => '腕時計', 'image_path' => 'products/Clock.jpg','price' =>15000],
            ['name' => 'HDD', 'image_path' => 'products/Disk.jpg','price' =>5000],
            ['name' => '玉ねぎ3束', 'image_path' => 'products/tamanegi.jpg','price' =>300],
            ['name' => '革靴', 'image_path' => 'products/Shoes.jpg','price' =>4000],
            ['name' => 'ノートPC', 'image_path' => 'products/Laptop.jpg','price' =>45000],
            ['name' => 'マイク', 'image_path' => 'products/Mic.jpg','price' =>8000],
            ['name' => 'ショルダーバッグ', 'image_path'=>'products/Bag.jpg','price' =>3500],
            ['name' => 'タンブラー', 'image_path'=>'products/Tumbler.jpg','price' =>500],
            ['name' => 'コーヒーミル', 'image_path'=>'products/Coffee+Grinder.jpg','price' =>4000],
            ['name' => 'メイクセット', 'image_path'=>'products/makeup.jpg','price' =>2500],            
        ];

        foreach ($items as $item) {
            Product::create([
                'name'       => $item['name'],
                'image_path' => $item['image_path'],
                'price'      => $item['price'], 
                'seller_id'  => $users->random()->id,   // ← user_id → seller_id に変更
                'buyer_id'   => null,                   // 未購入
            ]);
        }
    }
}

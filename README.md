# coachtech フリマアプリ
# 概要
- coachtech フリマアプリは、ユーザーが商品を出品・購入できるフリマサービスです。

# 主な機能
## ユーザー機能
- ユーザー登録
- ログイン / ログアウト
- プロフィール確認・編集
- 初回ログイン時のプロフィール設定

## 商品機能
- 商品一覧表示
- 商品詳細表示
- 商品出品
- 商品購入（Stripe Checkout 決済）
- 出品した商品一覧（マイページ）
- 購入した商品一覧（マイページ）

## 決済機能
-Stripe Checkout によるカード決済
-決済成功 / キャンセル画面の遷移
-決済後の購入処理（buyer_id 更新など）

# 使用技術
- PHP 8.x
- Laravel 10.x
- MySQL 8.x
- Docker / docker-compose
- Laravel Fortify
- Stripe API
- HTML / CSS

# 環境構築
- git clone git@github.com:itou-nanase/mogi1.git
- cd coachtech/laravel/mogi1
- docker compose up -d --build
- docker compose exec php bash
- cd src
- composer install
- cp .env.example .env
- Docker の MySQL に接続するため、以下の値を .env に設定してください。
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=laravel_user
  DB_PASSWORD=laravel_pass
  設定後、アプリキーを生成します。
- php artisan key:generate
- php artisan migrate --seed
- php artisan storage:link

# ER図
```mermaid
erDiagram

    USERS ||--o{ PRODUCTS : "sells"
    USERS ||--o{ PURCHASES : "buys"
    PRODUCTS ||--o{ COMMENTS : "has"
    PRODUCTS ||--o{ LIKES : "liked by"
    BRANDS ||--o{ PRODUCTS : "brand"
    CATEGORIES ||--o{ PRODUCTS : "category"
    CONDITIONS ||--o{ PRODUCTS : "condition"

    USERS {
        bigint id PK
        varchar name
        varchar email
        varchar password
        timestamp created_at
        timestamp updated_at
    }

    PRODUCTS {
        bigint id PK
        varchar name
        varchar image_path
        json categories
        bigint brand_id FK
        bigint category_id FK
        bigint condition_id FK
        text description
        int price
        bigint seller_id FK
        bigint buyer_id FK
        timestamp created_at
        timestamp updated_at
    }

    BRANDS {
        bigint id PK
        varchar name
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES {
        bigint id PK
        varchar name
        timestamp created_at
        timestamp updated_at
    }

    CONDITIONS {
        bigint id PK
        varchar label
        timestamp created_at
        timestamp updated_at
    }

    PURCHASES {
        bigint id PK
        bigint user_id FK
        bigint product_id FK
        timestamp created_at
    }

    COMMENTS {
        bigint id PK
        bigint product_id FK
        bigint user_id FK
        text body
        timestamp created_at
        timestamp updated_at
    }

    LIKES {
        bigint id PK
        bigint product_id FK
        bigint user_id FK
        timestamp created_at
        timestamp updated_at
    }

        bigint product_id FK
        timestamp created_at
    }

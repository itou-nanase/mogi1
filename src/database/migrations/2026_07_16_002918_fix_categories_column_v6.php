<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCategoriesColumnV6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    // 新しい JSON カラムを追加
    Schema::table('products', function (Blueprint $table) {
        $table->json('categories_json')->nullable();
    });

    // 古い categories の値を新しい JSON カラムへコピー
    DB::table('products')->update([
        'categories_json' => DB::raw('categories')
    ]);

    // 古いカラムを削除
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('categories');
    });

    // 新しいカラム名を追加（renameColumn を使わない）
    Schema::table('products', function (Blueprint $table) {
        $table->json('categories')->nullable();
    });

    // コピーした値を戻す
    DB::table('products')->update([
        'categories' => DB::raw('categories_json')
    ]);

    // 一時カラムを削除
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('categories_json');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('categories')->nullable();
    });
}
}


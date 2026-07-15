<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RebuildSellerIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // ① 既存の seller_id を削除
            $table->dropColumn('seller_id');
        });

        Schema::table('products', function (Blueprint $table) {
            // ② NOT NULL の seller_id を再作成
            $table->unsignedBigInteger('seller_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('seller_id');
        });

         Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id')->nullable()->after('id');
        });
    }
}

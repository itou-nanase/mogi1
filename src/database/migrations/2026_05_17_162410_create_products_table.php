<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('image_path')->nullable(); // ← これ1つだけ
        $table->unsignedBigInteger('buyer_id')->nullable();
        $table->unsignedBigInteger('brand_id')->nullable();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->unsignedBigInteger('condition_id')->nullable();
        $table->integer('price');
        $table->text('description')->nullable();
        $table->unsignedBigInteger('seller_id');
        $table->timestamps();
});

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

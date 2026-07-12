<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
        $table->json('categories')->nullable();
        $table->string('condition')->nullable();
        $table->string('brand')->nullable();
        $table->text('description')->nullable();
        $table->integer('price')->nullable();
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
            $table->dropColumn('categories');
            $table->dropColumn('condition');
            $table->dropColumn('brand');
            $table->dropColumn('description');
            $table->dropColumn('price');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product_categories', function (Blueprint $table) {
            //$table->collation = 'utf8mb4_bin';
            $table->unsignedInteger('product_id')->comment('商品ID');
            $table->unsignedInteger('category_id')->comment('カテゴリID');

            //制約の設定
            //$table->foreign('product_id')->references('id')->on('t_products');
            //$table->foreign('category_id')->references('id')->on('t_categories');
        });
        DB::statement("ALTER TABLE t_product_categories COMMENT '商品カテゴリ関連'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('t_product_categories', function (Blueprint $table) {
//            $table->dropForeign('t_product_categories_product_id_foreign');
//            $table->dropForeign('t_product_categories_category_id_foreign');
//        });

        Schema::dropIfExists('t_product_categories');
    }
}

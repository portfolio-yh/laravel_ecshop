<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModiForginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {




        //制約の設定
        Schema::table('t_product_categories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('t_products');
            $table->foreign('category_id')->references('id')->on('t_categories');
        });

        Schema::table('t_products', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('t_admins');
            $table->foreign('product_status_id')->references('id')->on('m_product_statuses');
        });

        Schema::table('t_admins', function (Blueprint $table) {
            $table->foreign('work_id')->references('id')->on('m_works');
            $table->foreign('creator_id')->references('id')->on('t_admins');
            $table->foreign('authority_id')->references('id')->on('m_authorities');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('t_product_categories', function (Blueprint $table) {
            $table->dropForeign('t_product_categories_product_id_foreign');
            $table->dropForeign('t_product_categories_category_id_foreign');
        });

        Schema::table('t_products', function (Blueprint $table) {
            $table->dropForeign('t_products_creator_id_foreign');
            $table->dropForeign('t_products_product_status_id_foreign');
        });

        Schema::table('t_admins', function (Blueprint $table) {
            $table->dropForeign('t_admins_work_id_foreign');
            $table->dropForeign('t_admins_creator_id_foreign');
            $table->dropForeign('t_admins_authority_id_foreign');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product_statuses', function (Blueprint $table) {
            //$table->collation = 'utf8mb4_bin';
            $table->smallIncrements('id');
            $table->string('name', 255)->comment('名称');
            $table->unsignedSmallInteger('sort_no')->comment('並び順');
        });
        DB::statement("ALTER TABLE m_product_statuses COMMENT '商品状態マスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_product_statuses');
    }
}

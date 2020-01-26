<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('t_products', function (Blueprint $table) {
            //$table->collation = 'utf8mb4_bin';
            $table->integerIncrements('id');                                          //符号なしINTを使用した自動増分ID（主キー）
            $table->unsignedInteger('creator_id')->comment('作成者ID');
            $table->unsignedSmallInteger('product_status_id')->comment('商品状態ID');
            $table->string('name', 255)->comment('商品名');
            $table->string('note', 4000)->comment('備考')->nullable();                 //nullble : null許容
            $table->string('description_list', 4000)->comment('リスト商品説明');
            $table->string('description_detail', 4000)->comment('商品説明詳細');
            $table->longText('search_word')->comment('検索ワード');
            $table->unsignedSmallInteger('delete_flag')->nullable();
            $table->timestamps();

            //制約の設定
            //$table->foreign('creator_id')->references('id')->on('t_members');
            //$table->foreign('product_status_id')->references('id')->on('m_product_statuses');
        });
        switch (env('DB_CONNECTION')) {
            case 'mysql':
                DB::statement("ALTER TABLE t_products COMMENT '商品情報'"); //mySQLの場合
                break;
            case 'pgsql':
                DB::statement("COMMENT ON TABLE t_products IS '商品情報'");//postgreSQLの場合
                break;
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

//        Schema::table('t_products', function (Blueprint $table) {
//            $table->dropForeign('t_products_creator_id_foreign');
//            $table->dropForeign('t_products_product_status_id_foreign');
//        });

        Schema::dropIfExists('t_products');
    }
}

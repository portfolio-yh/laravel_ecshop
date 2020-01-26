<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_authorities', function (Blueprint $table) {
            //$table->collation = 'utf8mb4_bin';
            $table->smallIncrements('id');                                            //符号なしSMALLINTを使用した自動増分ID（主キー）
            $table->string('name', 255)->comment('名称');                             //VARCHAR : 255
            $table->unsignedSmallInteger('sort_no')->comment('並び順');              //符号なしsmallint(5)
        });
        // ALTER 文を実行しテーブルにコメントを設定
        try {
            DB::raw("ALTER TABLE m_authorities COMMENT '管理者権限マスタ'"); //mySQLの場合
        } catch (Exception $e) {
            DB::raw("COMMENT ON TABLE m_works IS '管理者権限マスタ'");//postgreSQLの場合
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_authorities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_works', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 255)->comment('名称');
            $table->unsignedInteger('sort_no')->comment('並び順');                    //符号なしint(10) + null許容
            //$table->collation = 'utf8';

        });
        try {
            DB::raw("ALTER TABLE m_works COMMENT '管理者権限マスタ'"); //mySQLの場合
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

//        Schema::table('t_members', function (Blueprint $table) {
//            $table->dropForeign('t_admins_work_id_foreign');
//            $table->dropForeign('t_admins_creator_id_foreign');
//            $table->dropForeign('t_admins_authority_id_foreign');
//        });

        Schema::dropIfExists('m_works');
    }
}

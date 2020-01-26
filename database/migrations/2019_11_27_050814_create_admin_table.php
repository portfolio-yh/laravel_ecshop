<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('work_id')->nullable()->comment('管理ユーザー稼働状況ID');
            $table->unsignedSmallInteger('authority_id')->nullable()->comment('権限ID');
            $table->unsignedInteger('creator_id')->nullable()->comment('作成者ID');
            $table->string('name', 255)->comment('名称');
            $table->string('department')->nullable()->comment('部門');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password')->comment('ログインパスワード');
            $table->rememberToken();
            $table->smallInteger('sort_no')->unsigned()->comment('並び順');
            $table->smallInteger('delete_flag')->nullable();
            $table->timestamp('login_at');
            $table->timestamps();

            //制約の設定
            //$table->foreign('work_id')->references('id')->on('m_works');
            //$table->foreign('creator_id')->references('id')->on('t_admins');
            //$table->foreign('authority_id')->references('id')->on('m_authorities');

        });
        try {
            DB::raw("ALTER TABLE t_admins COMMENT '管理者権限マスタ'"); //mySQLの場合
        } catch (Exception $e) {
            DB::raw("COMMENT ON TABLE t_admins IS '管理者権限マスタ'");//postgreSQLの場合
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //制約の解除
        //Schema::table('t_members', function (Blueprint $table) {
            //外部キー解除 : dropForeign(<対象テーブル名>_<対象カラム>_foreign)
            //$table->dropForeign('t_admins_work_id_foreign');
            //$table->dropForeign('t_admins_creator_id_foreign');
            //$table->dropForeign('t_admins_authority_id_foreign');
        //});

        Schema::dropIfExists('t_admins');
    }
}

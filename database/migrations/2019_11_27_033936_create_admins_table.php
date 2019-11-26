<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('t_admins', function (Blueprint $table) {
//            $table->increments('id');
//            $table->unsignedSmallInteger('work_id')->nullable()->comment('管理ユーザー稼働状況ID');
//            $table->unsignedSmallInteger('authority_id')->nullable()->comment('権限ID');
//            $table->unsignedInteger('creator_id')->nullable()->comment('作成者ID');
//            $table->string('name', 255)->comment('名称');
//            $table->string('department')->nullable()->comment('部門');
//            $table->string('email')->unique()->comment('メールアドレス');
//            $table->string('password')->comment('ログインパスワード');
//            $table->rememberToken();
//            $table->smallInteger('sort_no')->unsigned()->comment('並び順');
//            $table->smallInteger('delete_flag')->nullable();
//            $table->timestamp('login_at');
//            $table->timestamps();
//        });
//        DB::statement("ALTER TABLE t_admins COMMENT '管理者情報'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('t_admins');
    }
}

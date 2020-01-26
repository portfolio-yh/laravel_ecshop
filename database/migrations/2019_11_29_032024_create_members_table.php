<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_members', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name', 200)->comment('姓名');
            $table->string('family_name', 100)->comment('姓');
            $table->string('family_name_kana', 100)->comment('カナ姓');
            $table->string('given_name', 100)->comment('名');
            $table->string('given_name_kana', 100)->comment('カナ名');
            $table->char('sex_type',1)->comment('性別');
            $table->string('address', 200)->nullable()->comment('住所');
            $table->string('address_postal_code', 28)->comment('郵便番号');
            $table->string('address_region', 40)->comment('都道府県');
            $table->string('address_locality', 40)->comment('市区町村');
            $table->string('email', 64)->comment('メールアドレス');
            $table->string('tel', 14)->comment('電話番号');
            $table->string('tel_area', 4)->comment('市外局番');
            $table->string('tel_city', 4)->comment('市内局番');
            $table->string('tel_subscriber', 4)->comment('加入者番号');
            $table->date('birthday')->comment('誕生日');
            $table->string('hobby')->comment('趣味');
            $table->string('updated_by', 200)->comment('更新者');
            $table->timestamps();                                                    //NULL値可能なcreated_atとupdated_atカラム追加

            //制約の設定
//            $table->foreign('work_id')->references('id')->on('m_works');              //外部キー : 「m_works」テーブルの「id」カラムを参照する、「t_members」のwork_idを定義。
//            $table->foreign('creator_id')->references('id')->on('t_members');
//            $table->foreign('authority_id')->references('id')->on('m_authorities');
        });
        try {
            DB::raw("ALTER TABLE t_members COMMENT '管理者権限マスタ'"); //mySQLの場合
        } catch (Exception $e) {
            DB::raw("COMMENT ON TABLE t_members IS '管理者権限マスタ'");//postgreSQLの場合
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

//        //制約の解除
//        Schema::table('t_members', function (Blueprint $table) {
//            //外部キー解除 : dropForeign(<対象テーブル名>_<対象カラム>_foreign)
//            $table->dropForeign('t_members_work_id_foreign');
//            $table->dropForeign('t_members_creator_id_foreign');
//            $table->dropForeign('t_members_authority_id_foreign');
//        });

        Schema::dropIfExists('t_members');
    }
}

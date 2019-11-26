<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_categories', function (Blueprint $table) {
            //$table->collation = 'utf8mb4_bin';
            $table->integerIncrements('id')->comment('カテゴリID');
            $table->unsignedInteger('parent_category_id')->nullable()->comment('親カテゴリID');
            $table->unsignedInteger('creator_id')->nullable()->comment('作成者ID');
            $table->string('category_name', 255)->comment('カテゴリ名');
            $table->unsignedInteger('hierarchy')->nullable()->comment('階層');
            $table->unsignedSmallInteger('sort_no')->comment('並び順');
            $table->smallInteger('delete_flag')->nullable();
            $table->timestamps();

            //制約の設定
            $table->foreign('creator_id')->references('id')->on('t_admins');

            //同テーブルに外部キーを設定。対象カラムが重複しないようにUNIQUE制約を先に設定。
            //$table->unique('parent_category_id', 'hierarchy');
            $table->foreign('parent_category_id')->references('id')->on('t_categories');
        });
        DB::statement("ALTER TABLE t_categories COMMENT 'カテゴリ情報'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('t_categories', function (Blueprint $table) {
            $table->dropForeign('t_categories_creator_id_foreign');
            $table->dropForeign('t_categories_parent_category_id_foreign');
        });

        Schema::dropIfExists('t_categories');
    }
}

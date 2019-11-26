<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class Seeder1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        //DB::table('t_members')->truncate();
        $now = Carbon::now();

        DB::table('m_authorities')->insert(
            [
                ['name' => 'システム管理者', 'sort_no' => 0],
                ['name' => '店舗オーナー'  , 'sort_no' => 1],
            ]);
        DB::table('m_product_statuses')->insert(
            [
                ['name' => '公開',   'sort_no' => 0],
                ['name' => '非公開', 'sort_no' => 1],
                ['name' => '廃止',   'sort_no' => 2],
            ]);
        DB::table('m_works')->insert(
            [
                ['name'  => '比稼働', 'sort_no' => 0],
                ['name'  => '稼働'  , 'sort_no' => 1],
            ]);



//         DB::table('t_admins')->insert(
//         [
//             [
//                 'work_id'      =>  1,
//                 'authority_id' =>  1,
//                 'creator_id'   =>  1,
//                 'name'         =>  'admin001',
//                 'department'   =>  null,
//                 'login_id'     =>  'admin001',
//                 'password'     =>  Hash::make('admin001'),
//                 'salt'         =>  Hash::make('admin001'),
//                 'sort_no'      =>  1,
//                 'created_at'   =>  $now,
//                 'updated_at'    => $now,
//             ],
//             [
//                 'work_id'      =>  2,
//                 'authority_id' =>  2,
//                 'creator_id'   =>  1,
//                 'name'         =>  'admin002',
//                 'department'   =>  null,
//                 'login_id'     =>  'admin002',
//                 'password'     =>  Hash::make('admin002'),
//                 'salt'         =>  Hash::make('admin002'),
//                 'sort_no'      =>  2,
//                 'created_at'   =>  $now,
//                 'updated_at'   =>  $now,
//             ],
//         ]);


        DB::table('t_admins')->insert(
            [
                [
                    'work_id'      =>  2,
                    'authority_id' =>  2,
                    'creator_id'   =>  1,
                    'name'         =>  'admin001',
                    'department'   =>  null,
                    'password'     =>  Hash::make('admin001'),
                    //'remember_token' => Hash::make('admin001'),
                    'email' => 'admin001@admin.co.jp',
                    'sort_no'      =>  1,
                    'created_at'   =>  $now,
                    'updated_at'    => $now,
                ],
                [
                    'work_id'      =>  1,
                    'authority_id' =>  1,
                    'creator_id'   =>  1,
                    'name'         =>  'admin001',
                    'department'   =>  null,
                    'password'     =>  Hash::make('admin002'),
                    //'remember_token' => Hash::make('admin002'),
                    'email' => 'admin002@admin.co.jp',
                    'sort_no'      =>  1,
                    'created_at'   =>  $now,
                    'updated_at'    => $now,
                ],

            ]);


        DB::table('t_categories')->insert(
            [
                [
                    'parent_category_id' => null,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリA',
                    'hierarchy'          => null,
                    'sort_no'            => 0,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => null,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリB',
                    'hierarchy'          => null,
                    'sort_no'            => 1,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => 1,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリAレベル1_1',
                    'hierarchy'          => 1,
                    'sort_no'            => 3,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => 1,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリAレベル1_2',
                    'hierarchy'          => 1,
                    'sort_no'            => 4,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => 2,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリBレベル1_1',
                    'hierarchy'          => 2,
                    'sort_no'            => 5,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => 5,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリBレベル2_1',
                    'hierarchy'          => 2,
                    'sort_no'            => 6,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],
                [
                    'parent_category_id' => 4,
                    //'creator_id'         => 1,
                    'category_name'      => 'カテゴリAレベル3_1',
                    'hierarchy'          => 3,
                    'sort_no'            => 7,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ],

            ]);




//         $authors = ['田中太郎','山田太郎','佐藤太郎'];
//         foreach ($authors as $author) {
//             DB::table('author')->insert('author');
//         }





    }
}

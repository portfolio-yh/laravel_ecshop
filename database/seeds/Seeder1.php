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
                    'login_at'     =>  $now,
                    'created_at'   =>  $now,
                    'updated_at'    => $now,
                ],
                [
                    'work_id'      =>  1,
                    'authority_id' =>  1,
                    'creator_id'   =>  1,
                    'name'         =>  'admin002',
                    'department'   =>  null,
                    'password'     =>  Hash::make('admin002'),
                    //'remember_token' => Hash::make('admin002'),
                    'email' => 'admin002@admin.co.jp',
                    'sort_no'      =>  1,
                    'login_at'     =>  $now,
                    'created_at'   =>  $now,
                    'updated_at'    => $now,
                ],

            ]);


        DB::table('t_members')->insert(
            [
                [
                    'name' => 'admin001',
                    'family_name' => 'admin',
                    'family_name_kana' => 'アドミン',
                    'given_name' => '001',
                    'given_name_kana' => 'ゼロゼロイチ',
                    'sex_type' => '0',
                    'address' => '住所12345678910',
                    'address_postal_code' => '123456',
                    'address_region' => '〇〇県',
                    'address_locality' => '〇〇市',
                    'email' => 'admin001@admin.co.jp',
                    'tel' => '0011112222',
                    'tel_area' => '00',
                    'tel_city' => '1111',
                    'tel_subscriber' => '2222',
                    'birthday' => '2019-01-02',
                    'hobby' => '1',
                    'updated_by' => 'admin001',
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

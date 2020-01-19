<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Database\QueryException;



use Illuminate\Http\Request;
use App\Http\Requests\Admin\MemberFormRequest;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use phpDocumentor\Reflection\Types\Mixed_;
use PhpParser\Node\Expr\Array_;

//use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;
use Composer\Package\Archiver\ZipArchiver;

class MembersController extends Controller
{

    public function index()
    {



        $data = DB::select("select * from t_admins where id <> 5;");

        $one = [];
        $results = [];
        foreach ($data as $row) {
            foreach ($row as $column => $value) {
                $one[$column] = $value;
            }
            if(count($data) === 1){
                return $one;
            }
            $results[] = $one;
        }
        return $results;






        $this->objectToArray($sql);
        dd(count($sql));

//        $array = array();
//        $array[] = [
//            'id' => '01',
//            'name' => 'name'
//        ];
//        $array['arr'] = [
//            'id' => null,
//            'name' => '',
//        ];
//
        $obj = new \stdClass();
        $obj->id = '02';
        $obj->name = null;
        $array[0]['obj'] = $obj;
//
//        $result = $this->stdObjToArray($array);
//        var_dump($result);

        $obj->obj2[0] = $obj->id;

        //dd($obj->obj2);

        $this->objectToArray($obj);


        //$this->obj2arr($obj);


        //dd($obj);



        //dd($sql, $this->stdObjToArray($array) );











    }


    /**
     * オブジェクト(stdClass)をすべて配列型にする変換する
     * @param array $arrays
     * @return array
     */
    private function objectToArray(&$data)
    {


        //if(( gettype($data) === 'object' || gettype($data) === 'array')){
        $class_name = 'stdClass';
        if(( $data instanceof $class_name || is_array($data) )){




            //settype( $data, 'array');
            //$data = (array)$data;
            //$test = array();
            foreach($data as &$val){



                if($val instanceof $class_name){
                    dump($val);

                }


//                if( $val instanceof $class_name || is_array($val) ) {
//                    $this->objectToArray($val);
//                }else{
//                    $data[0] = $key;
//                }

            }
        }



//        return array_map(function ($value) {
//
//            dump($value);
//
//            if(gettype($value) === 'object' && get_class($value) === 'stdClass'){
//                return (array)$value;
//            } else if(is_array($value)){
//                return $this->stdObjToArray($value);
//            }
//            return $value;
//            //return gettype($value) === 'object' && get_class($value) === 'stdClass' ? (array)$value : $value;
//        }, $array);

    }












    public function create(Request $request)
    {
        $is_old = \Session::get('_old_input');
        if(!is_null($is_old)){
            $request->merge($is_old);
            //$_POST = array_merge($_POST,$is_old); //グローバル変数にマージする場合
        }
        dump($request->all()); //確認用
        //dump($_POST);

        $birthday_date_day = $this->getVailLastDay( old("birthday_date.year"), old("birthday_date.month") );

        //\View::share('name', "シェアします"); TODO : 影響範囲は？

        return view('admin.member.create',compact('birthday_date_day'));
    }



    public function store(MemberFormRequest $request)
    {

        //入力画面へ戻る
        return redirect()
            ->route('member.create')
            ->withInput($request->except('password', 'password_confirmation', '_token'));



//        //クロージャーでカスタムルールを定義
//        \Validator::make($request->all(), [
//            'agreement' => ['required',
//                function ($attribute, $value, $fail) {
//                    if ($value === 'foo') {
//                        $fail($attribute.'はfooではダメ');
//                    }
//                },
//            ],
//        ])->validate(); //vaildate()で自動リダイレクト


//        if ($validator->fails()) {
//            return redirect('post/create')
//                ->withErrors($validator)
//                ->withInput();
//        }


        //MemberFormRequestからメソッドを呼び出す
        //$test = $request->test();
        //dd($test);

        // ブラウザリロード等での二重送信防止
        //$request->session()->regenerateToken();
        //return back();
    }






    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    /**
     * 年月から有効な最終日を返す
     * @param  int|string 年
     * @param  int|string 月
     * @return int|null   日
     */
    public function getVailLastDay($year, $month)
    {
        if( !is_numeric($year) && !is_numeric($month) ) {
            return null;
        }

        //月の最終日を配列へ
        $lastday = ['', 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        //うるう年計算
        $year = (int)$year;
        if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0){
            $lastday[2] = 29; //2月の最終日を29日に
        }
        return $lastday[(int)$month];
    }


    /**
     * 値がない配列を空文字で埋める
     * @param array $array
     * @return array
     */
    private function arrayEmptyStrPad(Array $array) : array
    {
        foreach ($array as $key => $value) {
            $array[$key] = $value ?? '';
        }
        return $array;
    }

    public function RedirectError(){

        if(session()->has('errors')){
            print 'エラーあり';
        }else{
            print 'エラーなし';
        }

        $data = session()->get('set_data', []);
        $data = $this->arrayEmptyStrPad($data);
        return view('admin.member.create', [
            'aa' => $data['aa'],
            'bb' => $data['bb'],
        ]);
    }



}

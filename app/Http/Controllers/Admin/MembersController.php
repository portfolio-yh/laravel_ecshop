<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\MemberFormRequest;
use App\Http\Controllers\Controller;


class MembersController extends Controller
{

    public function index()
    {
        return view('admin.member.index');
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

        dump($birthday_date_day);

        return view('admin.member.create',compact('birthday_date_day'));
    }

    public function store(MemberFormRequest $request)
    {
        //入力画面へ戻る
        return redirect()
            ->route('member.create')
            ->withInput($request->except('password', 'password_confirmation', '_token'));

        //MemberFormRequestからメソッドを呼び出す
        //$test = $request->test();
        //dd($test);

        // ブラウザリロード等での二重送信防止
        //$request->session()->regenerateToken();
        //return back();
    }

    /**
     * 年月から有効な最終日を返す
     * @param  int|string 年
     * @param  int|string 月
     * @return int|null   日
     */
    private function getVailLastDay($year, $month)
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
}

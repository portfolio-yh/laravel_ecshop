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
            $_POST = array_merge($_POST,$is_old); //グローバル変数にマージする場合
        }
        dump($request->all());
        dump($_POST);



        return view('admin.member.create');
    }

    public function store(MemberFormRequest $request)
    {

//        //独自バリデーションからメソッドを呼び出す
//        $test = $request->test();
//        dd($test);

        //入力画面へ戻る
        return redirect()
            ->route('member.create')
            ->withInput($request->except('password', 'password_confirmation', '_token'));

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
}

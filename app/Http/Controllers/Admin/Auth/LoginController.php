<?php

namespace App\Http\Controllers\Admin\Auth;            //変更


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;                          //追加

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';         //変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');  //変更
    }


    //オーバーライド
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    //オーバーライド
    protected function guard()
    {
        return \Auth::guard('admin');
    }

    //オーバーライド
    //adminのみログアウトするように変更
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        return redirect('/admin');
    }



}

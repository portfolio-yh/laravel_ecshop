<?php

namespace App;

//use Illuminate\Database\Eloquent\Model; //削除

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable //継承は「Authenticatable」
{

    //テーブル名
    protected $table = 't_admins';

    protected $guard = 't_admins';

    //$fillable指定したカラムのみ、create()やfill()、update()で値が代入される(ホワイトリスト)。
    protected $fillable = [
        'name', 'email','password', 'work_id', 'authority_id', 'creator_id', 'sort_no', 'department', 'login_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

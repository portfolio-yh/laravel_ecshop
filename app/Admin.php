<?php

namespace App;

//use Illuminate\Database\Eloquent\Model; //削除

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Admin
 *
 * @property int $id
 * @property int|null $work_id 管理ユーザー稼働状況ID
 * @property int|null $authority_id 権限ID
 * @property int|null $creator_id 作成者ID
 * @property string $name 名称
 * @property string|null $department 部門
 * @property string $email メールアドレス
 * @property string $password ログインパスワード
 * @property string|null $remember_token
 * @property int $sort_no 並び順
 * @property int|null $delete_flag
 * @property string $login_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereAuthorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereDeleteFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereSortNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereWorkId($value)
 * @mixin \Eloquent
 */
class Admin extends Authenticatable //継承は「Authenticatable」
{

    //テーブル名
    protected $table = 't_admins';

    //$fillable指定したカラムのみ、create()やfill()、update()で値が代入される(ホワイトリスト)。
    protected $fillable = [
        'name', 'email','password', 'work_id', 'authority_id', 'creator_id', 'sort_no', 'department', 'login_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //

}

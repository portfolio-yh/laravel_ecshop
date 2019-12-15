<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Authorities
 *
 * @property int $id
 * @property string $name 名称
 * @property int $sort_no 並び順
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Authorities whereSortNo($value)
 * @mixin \Eloquent
 */
class Authorities extends Model
{
    //管理者権限マスタ
    protected $table = 'm_authorities';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

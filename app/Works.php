<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Works
 *
 * @property int $id
 * @property string $name 名称
 * @property int $sort_no 並び順
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Works whereSortNo($value)
 * @mixin \Eloquent
 */
class Works extends Model
{
    //管理者稼働状況マスタ
    protected $table = 'm_works';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

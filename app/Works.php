<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    //管理者稼働状況マスタ
    protected $table = 'm_works';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorities extends Model
{
    //管理者権限マスタ
    protected $table = 'm_authorities';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

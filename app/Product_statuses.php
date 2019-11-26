<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_statuses extends Model
{
    //商品状態マスタ
    protected $table = 'm_product_statuses';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

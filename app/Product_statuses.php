<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product_statuses
 *
 * @property int $id
 * @property string $name 名称
 * @property int $sort_no 並び順
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product_statuses whereSortNo($value)
 * @mixin \Eloquent
 */
class Product_statuses extends Model
{
    //商品状態マスタ
    protected $table = 'm_product_statuses';

    protected $fillable = ['name', 'sort_no'];

    protected $guarded = ['id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //category情報
    protected $table = 't_categories';
    //protected $relations = 't_categories';

    protected $fillable = ['parent_category_id', 'creator_id', 'category_name', 'hierarchy', 'sort_no'];

    //, 'delete_flag', 'created_at', 'updated_at'

    protected $guarded = ['id'];



    // parent
    public function parent()
    {
        return $this->belongsTo(Categories::class,'parent_category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Categories::class, 'parent_category_id', 'id');
    }

    // all ascendants
    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }


    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }


    /**
     * 木構造化
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function treeStructure() {
        return self::with('childrenRecursive')->whereNull('parent_category_id')->get();
    }



    /**
     * 現在のIDからルートまでのデータをパンくずリストにして返す
     * @return Array
     */
    public static function breadCrumbs($cullent_id) {
        $collection = collect();
        $find = self::find($cullent_id, ['id','parent_category_id','category_name']);
        while ($find) {
            $arr = ['title' => $find->category_name,'url' => action('Admin\product\CategoryController@show', ['category' => $find->id])];
            $collection->push($arr);
            $find = self::find($find->parent_category_id, ['id','parent_category_id','category_name']);
        }
        $arr = ['title'  =>  'カテゴリ一覧', 'url' => action('Admin\product\CategoryController@index')];
        $collection->push($arr);
        return $collection->reverse('key')->all();
    }

    /**
     * 親IDがないルートデータのみ返す
     * @return Array
     */
    public static function rootsOnly(){
        return self::whereNull('parent_category_id')->get()->toArray();
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 't_categories';

    protected $fillable = ['parent_category_id', 'creator_id', 'category_name', 'hierarchy', 'sort_no'];

    protected $guarded = ['id'];

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
     * ルートカテゴリを返す
     * @return array
     */
    public static function getRootCategories(){
        return \DB::select("select id, category_name from t_categories where parent_category_id IS NULL");
        //return self::whereNull('parent_category_id')->select('id', 'category_name')->get();
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Categories
 *
 * @property int $id カテゴリID
 * @property int|null $parent_category_id 親カテゴリID
 * @property int|null $creator_id 作成者ID
 * @property string $category_name カテゴリ名
 * @property int|null $hierarchy 階層
 * @property int $sort_no 並び順
 * @property int|null $delete_flag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Categories[] $children
 * @property-read int|null $children_count
 * @property-read \App\Categories|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereDeleteFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereHierarchy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereParentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereSortNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Categories extends Model
{
    protected $table = 't_categories';

    protected $fillable = ['parent_category_id', 'creator_id', 'category_name', 'hierarchy', 'sort_no'];

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
     * ルートカテゴリを返す
     * @return array
     */
    public static function getRootCategories(){
        return \DB::select("select id, category_name, sort_no, hierarchy from t_categories where parent_category_id IS NULL order by sort_no asc");
        //return self::whereNull('parent_category_id')->select('id', 'category_name')->get();
    }


}

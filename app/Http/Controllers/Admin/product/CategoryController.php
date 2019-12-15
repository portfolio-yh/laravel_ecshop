<?php

namespace App\Http\Controllers\Admin\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\TCategories;
use PhpParser\Node\Stmt\Do_;

class CategoryController extends Controller
{

    /**
     * カテゴリ一覧トップ画面
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('admin.product.category_top',[
            'categories' => TCategories::treeStructure(),
            'breadcrumbs' => [['title'  =>  'カテゴリ一覧','url' => action('Admin\product\CategoryController@index')]]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        //dump($request->all());


        return back();






    }

    /**
     * カテゴリ詳細一覧
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find_categories = TCategories::find($id, ['id','parent_category_id','category_name']);
        $child_categories = $find_categories->children()->get(['id','parent_category_id','category_name']);
        $breadcrumbs = TCategories::breadCrumbs($id);
        return view('Admin.product.category_show', compact('find_categories', 'child_categories', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}







//         ネストされた関係を手動で取得する方法は次のとおりです。
//         $model = Model::with('relation1.relation2.relation3')->get();



//dd( TCategories::with('children')->get() );

//         dump( //dump(TCategories::all()),
//             //dump(TCategories::get()->toJson()),
//             //TCategories::get()->toArray(),
//             //TCategories::with('children')->get()

//         );

//$surveys = TCategories::with('childrenRecursive')->whereNull('parent_category_id')->get();

//var_dump( TCategories::with('childrenRecursive')->whereNull('parent_category_id')->get() );

//$data = TCategories::where('parent_category_id',1);

//         $data = TCategories::find(7);



//         $data = $data->with('childrenRecursive')->get()->toArray();

//         //$data = $data->with('parentRecursive')->get()->toArray();

//         foreach ($data as $item) {

//             ;
//         }




//$data = TCategories::find(1);



//$data->with('childrenRecursive')->get()->puluck('id');

//木構造
//dump( TCategories::with('childrenRecursive')->whereNull('parent_category_id')->get() );

//$data = TCategories::with('childrenRecursive')->whereNull('parent_category_id')->get();

//         $results = [];
//         $count = 0;

//         while (condition) {
//             ;
//         }

//         foreach ($data->toArray() as $category) {
//             $results[$count] += $category["id"];
//             $results[$count] += $category["parent_category_id"];
//             $results[$count] += $category["creator_id"];
//             $results[$count] += $category["category_name"];
//             $results[$count] += $category["hierarchy"];
//             $results[$count] += $category["created_at"];
//             $results[$count] += $category["updated_at"];
//             if(!isset("children_recursive")){
//                 condition = false;
//             }
//         }











//         $data = TCategories::with('childrenRecursive')->whereNull('parent_category_id')->get();

//         //$data->pluck("id");


//         $products = $data->flatten(1);

//         dump( $products->values()->all() );



//         dump($data);

//         dump( $data->toArray() );


//dump($flatten);




//$data->with('childrenRecursive');

//dump($data);


//         foreach ($data->children->all() as $child){

//             dump($child->category_name);

//         }




//$data = TCategories::where()->category_name;

//         foreach ($comments as $comment) {
//             //
//         }


//dump($data);








//var_dump($surveys);




//dump( $categories = TCategories::with('parent')->whereNull('parent_category_id')->get() );


//dump($find_categories = TCategories::find($id)->parent );


//$find_categories = TCategories::find(7);

//dump( $find_categories->with('parent')->whereBetween('parent_category_id', [1, 100])->get() );


//$parent_array = [];
//TCategories::parentRecursive(7, $parent_array);

//dump($parent_array);



//           $arr = [];
//           $find = TCategories::find($id);
//           do {
//               $arr[] = $find->toArray();
//               $find = TCategories::find($find->parent_category_id);
//           } while (isset($find->parent_category_id));




//          $collection = collect();
//           $find = TCategories::find($id);
//           do {
//               $collection->push($find->toArray());
//               $find = TCategories::find($find->parent_category_id);
//           } while (isset($find->parent_category_id));







//           while (true) {
//               if(isset($find->parent_category_id)){
//                   echo '1';
//                   $arr += $find->toArray();
//                   //$arr += $find->parent->toArray();
//                   $find = TCategories::find($find->parent_category_id);
//               }
//               break;
//           }

//           dd($arr);



//dump( $find_categories->parent->toArray() );


//          dump($test = $find_categories->parentRecursive()->withDefault([
//              parent_category_id => 'non'

//          ]
//              ) );



//         foreach ($categories as $value) {
//             dump($value);
//         }



//dump( $find_categories->parent()->get('id') );


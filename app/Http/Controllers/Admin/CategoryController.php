<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\Admin\CategoryFormRequest;
use App\Categories;
use Illuminate\Contracts\Validation\Validator;  // 追加
use Illuminate\Http\Exceptions\HttpResponseException;  // 追加
use PDO;




class CategoryController extends Controller
{
    /**
     * カテゴリ一覧トップ画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = Categories::getRootCategories();
        return view('admin.category.index', compact('categories'));
    }



    /**
     * カテゴリ詳細
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $current_category = Categories::find($id, ['id','parent_category_id','category_name','sort_no','hierarchy']);
        $child_categories = $current_category->children()->orderBy('sort_no')->get(['id','parent_category_id','category_name','sort_no','hierarchy']);
        return view('admin.category.show', compact('current_category', 'child_categories'));
    }

    /**
     * カテゴリ作成
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validator($request->all());

        Categories::create([
            'parent_category_id' => $request->input('parent_category_id'),
            'category_name'      => $request->input('category_name'),
            'hierarchy'          => $request->input('hierarchy'),
            'creator_id'         => \Auth::user()->getAuthIdentifier(),
            'sort_no'            => Categories::max('sort_no') + 1,
            //'sort_no'          => \DB::table('t_categories')->max('sort_no') + 1,
        ]);

        return back();
    }

    /**
     * カテゴリ名編集画面
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        session()->put('backURL', url()->previous());
        return view('admin.category.edit',[
            'category' => Categories::find($id, ['id', 'category_name']),
        ]);
    }

    /**
     * カテゴリ名編集処理
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all());
        Categories::where('id', $id)->update(['category_name' => $request->name,]);
        return redirect()->to(session()->pull('backURL'));
    }

    /**
     * カテゴリ削除処理
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            Categories::find($id)->delete();
        } catch (\Exception $e) {
            errorView($e);
        }
        return back();
    }

    /**
     * 現在のカテゴリ順を上へ
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sortUp(Request $request)
    {
        $this->validator($request->all());

        $sort_no = $request->query('sort_no');
        $hierarchy = $request->query('hierarchy');
        try {
            $dbh = \DB::connection()->getPdo();
            $stmt = $dbh->prepare("
                UPDATE t_categories
                SET
                  sort_no = CASE
                    WHEN sort_no = :sort_no
                      THEN ( SELECT sort_no FROM t_categories WHERE sort_no < :sort_no AND hierarchy = :hierarchy  ORDER BY sort_no DESC limit 1 )
                    WHEN sort_no = ( SELECT sort_no FROM t_categories WHERE sort_no < :sort_no AND hierarchy = :hierarchy ORDER BY sort_no DESC limit 1 )
                      THEN :sort_no
                    ELSE sort_no
                    END
                WHERE
                  hierarchy =  :hierarchy
            ");
            $stmt->bindParam(':sort_no', $sort_no);
            $stmt->bindParam('hierarchy', $hierarchy);
            $stmt->execute();
        } catch (\Exception $e) {
            errorView($e);
        }

        return back();

    }

    /**
     *
     * 現在のカテゴリ順を下へ
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sortDown(Request $request){

        $this->validator($request->all());

        $sort_no = $request->query('sort_no');
        $hierarchy = $request->query('hierarchy');

        //dd($sort_no,$hierarchy);


        try {
            $dbh = \DB::connection()->getPdo();
            $stmt = $dbh->prepare("
                UPDATE t_categories
                SET
                  sort_no = CASE
                    WHEN sort_no = :sort_no
                      THEN ( SELECT sort_no FROM t_categories WHERE sort_no > :sort_no AND hierarchy = :hierarchy  ORDER BY sort_no ASC limit 1 )
                    WHEN sort_no = ( SELECT sort_no FROM t_categories WHERE sort_no > :sort_no AND hierarchy = :hierarchy ORDER BY sort_no ASC limit 1 )
                      THEN :sort_no
                    ELSE sort_no
                    END
                WHERE
                  hierarchy =  :hierarchy
            ");
            $stmt->bindParam(':sort_no', $sort_no);
            $stmt->bindParam('hierarchy', $hierarchy);
            $stmt->execute();
        } catch (\Exception $e) {
            errorView($e);
        }

        return back();
    }

    /**
     *
     * @param  array  $data
     * @return array
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'category_name' => ['filled','string','unique:t_categories','max:50'],
            'hierarchy' => ['filled','integer'],
            'parent_category_id' => ['nullable', 'integer', 'min:1'],
            'sort_no' => ['filled', 'integer'],
        ])->validate();


//        $validator = \Validator::make($data, [
//            'category_name' => ['required','string','unique:t_categories','max:50'],
//            'hierarchy' => ['required','integer'],
//            'parent_category_id' => ['nullable', 'integer', 'min:1']
//        ]);

//        $response['data']    = [];
//        $response['status']  = 'NG';
//        $response['summary'] = 'Failed validation.';
//        $response['errors']  = $validator->errors()->toArray();
//
//        throw new HttpResponseException(
//            response()->json( $response, 422 )
//        );

//        return response()->json([
//            'name' => ‘taro’,
//            'id' => 1
//        ]);

//        if ($validator->fails()) {
//            return back()
//                ->withErrors($validator)
//                ->withInput();
//        }

    }


}

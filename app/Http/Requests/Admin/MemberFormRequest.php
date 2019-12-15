<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;



class MemberFormRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }




    //ヴァリデーション前にフォームの入力値を変換 : allのほうが安全？ https://blog.capilano-fw.com/?p=579
    protected function prepareForValidation()
    {
        //$validator = parent::getValidatorInstance();

        //半角カナを全角カナへ
        $this->merge([
            'family-name_kana' =>  $this->filled('family-name_kana')
                ? mb_convert_kana( $this->input("family-name_kana"), 'KV', "UTF-8"  ) : null,
            'given-name_kana' => $this->filled('given-name_kana')
                ? mb_convert_kana( $this->input("given-name_kana"), 'KV', "UTF-8" ) : null,
        ]);

        //電話番号にハイフンがある場合削除
        $this->merge([
            'tel' =>  $this->filled('tel')
                ? preg_replace('/[^0-9]/u','', $this->input('tel')) : null,
        ]);


        foreach ($this->all() as $key => $value) {
            if(!is_string($value)) continue;

            //文字列の前後の空白文字を削除(全角・半角)
            //trim(mb_convert_kana($value, "s", 'UTF-8'));
            $value = preg_replace('/^[ 　]+/u', '', $value);
            $value = preg_replace('/[ 　]+$/u', '', $value);
            $this->merge([
                $key => $value,
            ]);

            //全角数字を半角数字へ
            $string_integer = mb_convert_kana($value, 'n', "UTF-8");
            if(ctype_digit($string_integer)){
                $this->merge([
                    $key => $string_integer,
                ]);
            }
        }
    }





    public function attributes()
    {
        return[
            'family-name' => "名前(姓)",
            'family-name_kana' => "フリガナ(姓)",
            'given-name' => "名前(名)",
            'given-name_kana' => "フリガナ(名)",
            'birthday_date.*' => '生年月日', //ワイルドカードで「birthday_date.year birthday_date.month birthday_date.day」を省略
            'age' => '年齢',
            'sex_id' => '性別',
            'hobby' => '趣味',
            'tel' => '連絡先電話番号',
            'password2' => 'パスワード確認'
        ];
    }

    public function rules()
    {

//        //バリデーションルール拡張例 : https://www.larajapan.com/2016/07/19/%E3%82%AB%E3%82%B9%E3%82%BF%E3%83%A0%E3%83%90%E3%83%AA%E3%83%87%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3-1-validator%E3%83%95%E3%82%A1%E3%82%B5%E3%83%BC%E3%83%89%E3%81%AEextend/
//        Validator::extend('kana', function($attribute, $value, $parameters, $validator) {
//            // 半角空白、全角空白、全角記号、全角かなを許可
//            return preg_match("/^[ぁ-んー 　！-＠［-｀｛-～]+$/u", $value);
//        });

        return [
            '*_name'          => ['nullable', 'string', 'regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u', 'max:5'],
            '*_name_kana'     => ['nullable', 'string', 'regex:/^[\p{Katakana}]+$/u', 'max:5'],
            'sex_id'          => ['nullable','integer'],                                  //ラジオボタン
            'birthday_date.*' => ['nullable', ],                                           //ワイルドカード使用(配列)
            'age'             => ['nullable','integer','digits_between:1,3'],
            'hobby'           => ['nullable','array','distinct'],                                //チェックボックス(配列)
            'tel'             => ['nullable','regex:/^(0{1}\d{9,10})$/u'],                //電話番号ハイフンなし
            'email'           => ['nullable', 'string', 'email', 'max:255', 'unique:t_members'],
            'password'        => ['nullable', 'string', 'min:8', 'same:password2'],              //same:フィールド名(指定したフィールドと同じ値であるかどうか)
            'agreement'       => ['nullable'],


            //バリデーション参考(same,comfimedなどの指定系) : https://qiita.com/fagai/items/9904409d3703ef6f79a2


            //参考(郵便番号検索) : https://blog.capilano-fw.com/?p=1215
            //参考（配列ヴァリデーション） : https://www.larajapan.com/2016/10/23/%E3%83%90%E3%83%AA%E3%83%87%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3-8-%E9%85%8D%E5%88%97%E3%82%92%E3%83%90%E3%83%AA%E3%83%87%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%81%99%E3%82%8B/

            //正規表現補足メモ
            //オプション uはutf
            // regex:/^[a-zA-Z0-9ａ-ｚA-Zぁ-んァ-ヶー一-龠]+$/u         記号禁止
            // regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u'           全角ひらがなカタカナ漢字のみ
            // regex:/^[\p{Katakana}]+$/u                           全角カナのみ
            // regex:/^[\p{Hiragana}]+$/u                           全角ひらがなのみ
            // regex:/^[\p{Han}]+$/u                                漢字のみ
            // regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/u     電話番号ハイフンあり
            // regex:/^(0{1}\d{9,10})$/u                            電話番号ハイフンなし


        ];
    }




    public function messages()
    {
        return[
            '*name_kana.regex'    => ':attributeは全角カタカナで入力してください。',
            '*_name'              => ':attributeの書式が正しくありません。',
            'birthday_date.array' => ':attributeを選択してください。',
            'birthday_date'       => '生年月日を選択してください。',
            'hobby.required'      => '趣味を選択してください。',
            'tel.regex'           => '連絡先電話番号をお確かめください。',
            'agreement.required'  => '登録に同意するボタンをクリックしてください',
        ];

    }

    //フォームリクエストへのAfterフックを追加
    public function withValidator(Validator $validator)
    {

        //dd($validator);

        //methot取得(GET,PUT,POST)
        //$this->method()

        //ルート名取得
        if(\Route::currentRouteName() == "member.store"){

        }

        //エラーがある場合return
        if($validator->fails()) return;



//        //追加ルール
//        $validator->sometimes('agreement','test',function ($data){
//            return 0;
//        });

        //追加ルール実行
        $validator->after(function ($validator) {

//            //生年月日が有効な日付か確認
//            $arr = $this->input('birthday_date');
//            if(!checkdate($arr['day'],$arr['month'],$arr['year']) ){
//                $validator->errors()->add('birthday_date.*', '選択された生年月日は存在しません。');
//            }

//            //カスタムメソッド呼び出し
//            if(! $this->customTest()){
//                $validator->errors()->add('birthday_date', 'カスタムエラーテスト');
//            }



        });
    }

    //カスタムメソッド
    public function customTest(){
        return false;
    }

//    //csvを返す
//    public function getCsvData()
//    {
//        $csvFile = $this->file('csv');
//        $csvData = array();
//        /* 受け取ったCSVファイルをからデータを取り出す */
//        return $csvData;
//    }

//    //jsonを返す
//    public function decodedData()
//    {
//        $data = $this->all();
//        $data['json'] = json_decode($data['json'],true);
//
//        return $data;
//    }







}

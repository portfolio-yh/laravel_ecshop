@extends('layouts.app')
@section('head-js')
    {{--    htmlファザードを利用する場合 : http://recipes.laravel.jp/recipe/254--}}
    <script src="{{ asset('js/validate-pulldown.js') }}" defer></script>
@endsection
@section('content')
<div class="card">
    <div class="card-header">一般登録テスト用</div>
    <div class="card-body">
        @if($errors->any())
                <ul class="alert alert-danger" role="alert">
            @foreach ($errors->unique() as $error)
                    <li class="ml-4">{{ $error }}</li>
            @endforeach
                </ul>
        @endif



        <form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="{{ route('member.store') }}" novalidate> {{-- novalidate でhtml側のバリデーションを無効化--}}
            @csrf
            <div class="row">
                <label class="col-3" for="family_name">名前(姓)* @error('family_name') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="family_name" type="text" placeholder="全角15文字以内" name="family_name" value="{{ old('family_name') }}" autocomplete="family-name" maxlength="15">
                <label class="col-3" for="family_name_kana">フリガナ(姓)* @error('family_name_kana') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="family_name_kana" type="text" placeholder="全角カナ15文字以内" name="family_name_kana" value="{{ old('family_name_kana') }}" maxlength="15">
            </div><hr>

            <div class="row">
                <label class="col-3" for="given_name">名前(名)* @error('given_name') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="given_name" type="text" placeholder="全角15文字以内" name="given_name" value="{{ old('given_name') }}"  autocomplete="given-name" maxlength="15">　
                <label class="col-3" for="given_name_kana">フリガナ(名)* @error('given_name_kana') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="given_name_kana" type="text" placeholder="全角カナ15文字以内" name="given_name_kana" value="{{ old('given_name_kana') }}" maxlength="15">　
            </div><hr>

            <div class="row">
                <div class="col-3">性別* @error('sex_id') <br><strong class="text-danger">{{ $message }}</strong> @enderror</div>
                <label class="mr-1"><input type="radio" name="sex_id" value="1">男</label>
                <label class="mx-1"><input type="radio" name="sex_id" value="2">女</label>
            </div><hr>

            <div class="row dateChange">
                <div class="col-3">生年月日* @error('birthday_date.*') <br><strong class="text-danger">{{ $message }}</strong> @enderror</div>
                <div>
                    <select name="birthday_date[year]" class="dateChangeYear" style="width: 5rem;">
                        <option value=""></option>
                        @for ($i = date('Y'); $i >= (date('Y') - 120) ; $i--)
                            @if($i == old('birthday_date.year'))
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                    <span class="px-1">年</span>
                    <select name="birthday_date[month]" class="dateChangeMonth" style="width:3rem;">
                         <option value=""></option>
                     @for ($i = 1; $i <= 12 ; $i++)
                         @php($zero_padding = substr( ('0' . $i), -2 )) {{-- substrによる0埋め --}}
                         @if($zero_padding == old('birthday_date.month'))
                         <option value="{{ $zero_padding }}" selected="selected">{{ $zero_padding }}</option>
                         @else
                         <option value="{{ $zero_padding }}">{{ $zero_padding }}</option>
                         @endif
                     @endfor
                    </select>
                    <span class="px-1">月</span>
                    <select name="birthday_date[day]" class="dateChangeDay" style="width:3rem;">
                        <option value=""></option>
                        @if(is_numeric($birthday_date_day))
                            @for ($i = 1; $i <= $birthday_date_day ; $i++)
                                @php($zero_padding = sprintf('%02d',$i) ) {{-- sprintfによる0埋め --}}
                                @if($zero_padding == old('birthday_date.day'))
                                    <option value="{{ $zero_padding }}" selected="selected">{{ $zero_padding }}</option>
                                @else
                                    <option value="{{ $zero_padding }}">{{ $zero_padding }}</option>
                                @endif
                            @endfor
                        @endif
                    </select>
                    <span class="px-1">日</span>
                </div>
            </div><hr>

            <div class="row">
                <label class="col-3" for="age">年齢* @error('age') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input type="text"  id="age" name="age" value="{{ old('age') }}" placeholder="半角数字3文字以内" maxlength="3">
            </div><hr>

            <div class="row">
                <label class="col-3" for="tel">連絡先電話番号* @error('tel') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="tel" type="text" placeholder="xxxxxxxxxxx" name="tel" value="{{ old('tel') }}" autocomplete="tel" maxlength="15">
            </div><hr>

            <div class="row">
                <div class="col-3">あなたの趣味(任意) @error('hobby') <br><strong class="text-danger">{{ $message }}</strong> @enderror </div>
                <div class="col-8">
                    {{--                    参考(name属性の配列要素をoldで取得する方法) : https://www.yukiiworks.com/archives/264            --}}
                    <label class="mx-1"><input type="checkbox" name="hobby[1]" value="1" {{  old('hobby.1') ? 'checked' : '' }}>勉強</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[2]" value="2" {{  old('hobby.2') ? 'checked' : '' }}>読書</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[3]" value="3" {{  old('hobby.3') ? 'checked' : '' }}>スポーツ</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[4]" value="4" {{  old('hobby.4') ? 'checked' : '' }}>アニメ・ゲーム</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[5]" value="5" {{  old('hobby.5') ? 'checked' : '' }}>映画鑑賞</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[6]" value="6" {{  old('hobby.6') ? 'checked' : '' }}>旅行</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[7]" value="7" {{  old('hobby.7') ? 'checked' : '' }}>音楽</label>
                    <label class="mx-1"><input type="checkbox" name="hobby[8]" value="8" {{  old('hobby.8') ? 'checked' : '' }}>料理</label>
                </div>
            </div><hr>

            <div class="row">
                <label class="col-3" for="email">メールアドレス* @error('email') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" maxlength="34" autocomplete="email">
            </div><hr>

            <div class="row">
                <label class="col-3" for="email">パスワード* @error('password') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="password" type="password" name="password" autocomplete="new-password">
            </div><hr>

            <div class="row">
                <label class="col-3" for="email">パスワード確認*</label>
                <input id="password2" type="password" class="" name="password2" autocomplete="new-password">
            </div><hr>

            <div class="row">
                <label class="col-3" for="agreement">登録に同意する @error('agreement') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input type="checkbox" name="agreement" id="agreement" value="1">
            </div><hr>

            <button type="submit" class="col-3 mx-auto btn btn-block btn-primary">{{ __('Register') }}</button>


            {{--

            <div class="row">
                <label class="col-3" for="avatar">アバター(画像ファイル) @error('avatar') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                <input id="avatar" type="file" id="avatar" accept="image/*" multiple>
            </div><hr>


            <label class="pr-2" for="name">氏名</label>
            <input id="name" type="text" placeholder="全角15文字" name="name">
            <hr>

            <label class="col-3" for="address_postal_code">郵便番号*</label>
            <input id="address_postal_code" type="text" placeholder="半角数字7桁" name="address_postal_code" maxlength="7">
            <hr>


            <label class="col-3" for="address_postal_code">郵便番号*</label>
            <input type="text" id="address_postal_code1" name="address_postal_code1" placeholder="上3桁" autocomplete="postal-code" size="3" maxlength="3" >
            <span class="mx-1">-</span>
            <input type="text" id="address_postal_code2" name="address_postal_code2" placeholder="下4桁"  size="4" maxlength="4">
            <hr>

            <label class="col-3" for="address_region">都道府県*</label>
            <input id="address_region" type="text" placeholder="全角15文字" autocomplete="address-level1" name="address_region">
            <hr>

            <label class="col-3" for="address_locality">市区町村*</label>
            <input id="address_locality" type="text" placeholder="全角15文字" autocomplete="address-level2" name="address_locality">
            <hr>


            <label class="col-3" for="address">それ以降の住所*</label>
            <input id="address" type="text" placeholder="全角40文字" autocomplete="address-line1" name="address">
            <hr>

            <label class="col-3" for="tel">電話番号*</label>
            <input id="tel_area" type="text" placeholder="市外局番(4)" name="tel_area" maxlength="4">
            <span class="mx-1">-</span>
            <input id="tel_city" type="text" placeholder="市内局番(4)" name="tel_city" maxlength="4">
            <span class="mx-1">-</span>
            <input id="tel_subscriber" type="text" placeholder="加入者番号(4)" name="tel_subscriber" maxlength="4">
            <hr>

            <label class="col-3" for="avatar">添付(テキストファイル)</label>
            <input id="avatar" type="file" id="avatar" accept="text/plain" multiple>
            <hr>


            --}}


        </form>
    </div>
</div>
@endsection

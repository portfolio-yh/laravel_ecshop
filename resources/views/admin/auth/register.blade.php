@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">管理者登録テスト用</div>

                {{-- is-invalid --}}


                <div class="card-body">
                    {{-- novalidate でhtml側のバリデーションを無効化--}}
                    <form method="POST" action="{{ route('admin.register') }}" novalidate>
                        @csrf




                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{  __('Name') }}(必須)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}(必須)</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}(必須)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}(必須)</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}(必須)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



あなたの趣味
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="1">勉強</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="2">読書</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="3">スポーツ</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="4">アニメ・ゲーム</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="5">映画鑑賞</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="6">旅行</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="7">音楽</label>
<label class="checkbox-inline"><input type="checkbox" id="hobby" name="hobby[]" value="8">料理</label>


<input type="text" placeholder="xsのとき100％、smのとき50％" class="size-xs-100 size-sm-50">　[xs]-[sm]-[md]-[lg] 各5～100％の間で5％刻み
<hr>
<input type="text" placeholder="氏名" class="size-input-name">　全角15文字
<hr>
<input type="text" placeholder="氏" class="size-input-nameS">
<input type="text" placeholder="名" class="size-input-nameS">　全角7文字×2
<hr>
<input type="text" placeholder="会社名" class="size-input-company">　全角16文字
<hr>
<input type="text" placeholder="部署名" class="size-input-division">　全角16文字
<hr>
<input type="text" placeholder="従業員数" class="size-input-quantity">　全角4文字
<hr>
〒 <input type="text" placeholder="7桁" class="size-input-zip" maxlength="8">　半角7文字
<hr>
〒 <input type="text" placeholder="上3桁" class="size-input-zip3" maxlength="3"> - <input type="text" placeholder="下4桁" class="size-input-zip4" maxlength="4">　半角3文字＋半角4文字
<hr>
<input type="text" placeholder="都道府県" class="size-input-pref">　全角5文字
<hr>
<input type="text" placeholder="住所" class="size-input-address">　全角25文字
<hr>
<input type="text" placeholder="電話番号" class="size-input-tel" maxlength="14">　半角14文字
<hr>
<input type="text" placeholder="市外局番" class="size-input-telS" maxlength="4"> - <input type="text" placeholder="市内局番" class="size-input-telS" maxlength="4"> - <input type="text" placeholder="加入者番号" class="size-input-telS" maxlength="4">　半角4文字×3
<hr>
<input type="text" placeholder="Web site" class="size-input-homepage">　半角60文字
<hr>
<input type="text" placeholder="メールアドレス" class="size-input-email ">　半角34文字
<input type="text" placeholder="xsのとき100％、smのとき50％" class="size-xs-100 size-sm-50">　[xs]-[sm]-[md]-[lg] 各5～100％の間で5％刻み
<hr>
<input type="text" placeholder="氏名" class="size-input-name">　全角15文字
<hr>
<input type="text" placeholder="氏" class="size-input-nameS">
<input type="text" placeholder="名" class="size-input-nameS">　全角7文字×2
<hr>
<input type="text" placeholder="会社名" class="size-input-company">　全角16文字
<hr>
<input type="text" placeholder="部署名" class="size-input-division">　全角16文字
<hr>
<input type="text" placeholder="従業員数" class="size-input-quantity">　全角4文字
<hr>
〒 <input type="text" placeholder="7桁" class="size-input-zip" maxlength="8">　半角7文字
<hr>
〒 <input type="text" placeholder="上3桁" class="size-input-zip3" maxlength="3"> - <input type="text" placeholder="下4桁" class="size-input-zip4" maxlength="4">　半角3文字＋半角4文字
<hr>
<input type="text" placeholder="都道府県" class="size-input-pref">　全角5文字
<hr>
<input type="text" placeholder="住所" class="size-input-address">　全角25文字
<hr>
<input type="text" placeholder="電話番号" class="size-input-tel" maxlength="14">　半角14文字
<hr>
<input type="text" placeholder="市外局番" class="size-input-telS" maxlength="4"> - <input type="text" placeholder="市内局番" class="size-input-telS" maxlength="4"> - <input type="text" placeholder="加入者番号" class="size-input-telS" maxlength="4">　半角4文字×3
<hr>
<input type="text" placeholder="Web site" class="size-input-homepage">　半角60文字
<hr>
<input type="text" placeholder="メールアドレス" class="size-input-email ">　半角34文字


<input type="checkbox" name="agreement" id="agreement" value="1" required /><label for="agreement">同意する</label>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>








                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

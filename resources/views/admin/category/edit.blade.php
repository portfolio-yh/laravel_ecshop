@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">カテゴリ編集</div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="{{ route('category.update', $category->id) }}" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <label class="col-3" for="family_name">カテゴリ名: @error('name') <br><strong class="text-danger">{{ $message }}</strong> @enderror</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $category->category_name) }}" autocomplete="family-name" maxlength="15">
                </div>
                <hr>
                <div class="btn-group d-flex justify-content-center" role="group" aria-label="...">
                    <button type="submit" class="mx-1 btn btn-primary col-3">更新</button>
                    <a href="{{ session()->get('backURL') }}" class="mx-1 btn btn-block btn-primary col-3">戻る</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('content')
    <form action="{{ route( 'category.store') }}" method="post">
        <div class="form-row mb-3">
            <div class="col-auto">
                {{ csrf_field() }}
                <input type="hidden" id="parent_category_id" name="parent_category_id" value="1">
                <input type="hidden" id="hierarchy" name="hierarchy" value="1">
            </div>
            <div class="col-auto">
                <span>@error('category_name')※@enderror</span>
            </div>
            <div class="col-auto">
                <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name') }}" required="required">
            </div>
            <div class="col-auto">
                <input class="btn btn-primary" type="submit" value="カテゴリ追加">
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>カテゴリ</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr class="flex-row ">
                <td>
                    <a href="{{ route( 'category.show', ['category' => $category->id] ) }}">{{ $category->category_name }}</a>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-warning" type="submit" value="⇧">
                    </form>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-warning" type="submit" value="⇩">
                    </form>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-success" type="submit" value="編集">
                    </form>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-danger" type="submit" value="削除">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@extends('layouts.admin')
@section('content')
    <form action="{{ route( 'category.store') }}" method="post" class="form-inline">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <span>@error('category_name')※@enderror</span>
            <input type="text" id="category_name" name="category_name" class="form-control"
                   value="{{ old('category_name') }}" required="required">
            {{--            <input type="hidden" id="parent_category_id" name="parent_category_id" value="">--}}
            <input type="hidden" id="hierarchy" name="hierarchy" value="0">
            <input class="btn btn-primary ml-1" type="submit" value="この階層にカテゴリ追加">
        </div>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>カテゴリ</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr class="flex-row ">
                <td>
                    <a href="{{ route( 'category.show', ['category' => $category->id] ) }}">{{ $category->category_name }}</a>
                </td>
                <td>
                    <a href="{{ url('/admin/category_sortUp/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning">↑</a>
                </td>
                <td>
                    <a href="{{ url('/admin/category_sortDown/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning">↓</a>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        @csrf
                        <input class="btn btn-success" type="button" value="編集">
                    </form>
                </td>
                <td>
                    <form action="{{ route( 'category.edit', ['category' => $category->id] ) }}" method="post">
                        @csrf
                        <input class="btn btn-danger" type="submit" value="削除">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

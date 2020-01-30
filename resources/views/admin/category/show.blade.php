@extends('layouts.admin')
@section('content')
    <form action="{{ route( 'category.store') }}" method="post" class="form-inline">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <span>@error('category_name')※@enderror</span>
            <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name') }}" required="required">
            <input type="hidden" id="parent_category_id" name="parent_category_id" value="{{ $current_category->id }}">
            <input type="hidden" id="hierarchy" name="hierarchy" value="{{ $current_category->hierarchy + 1 }}">
            <input class="btn btn-primary ml-1" type="submit" value="この階層にカテゴリを追加">
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            @isset($current_category->parent_category_id)
            <th colspan="5"><a href="{{ route( 'category.show', ['category' => $current_category->parent_category_id] ) }}">⇧</a>　カテゴリ</th>
            @else
            <th colspan="5"><a href="{{ route( 'category.index') }}">⇧</a>　カテゴリ</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @isset($child_categories)
            @foreach ($child_categories as $category)
                <tr>
                    <td>
                        <a href="{{ route( 'category.show', ['category' => $category->id] ) }}">{{ $category->category_name }}</a>
                    </td>
                    <td colspan="4" class="d-flex justify-content-end">
                        @if($loop->count === 1)
                            <span class="btn btn-warning mx-1">×</span>
                            <span class="btn btn-warning mx-1">×</span>
                        @elseif($loop->first)
                            <span class="btn btn-warning mx-1">×</span>
                            <a href="{{ url('/admin/category_sortDown/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning mx-1">⇩</a>
                        @elseif ($loop->last)
                            <a href="{{ url('/admin/category_sortUp/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning mx-1">⇧</a>
                            <span class="btn btn-warning mx-1">×</span>
                        @else
                            <a href="{{ url('/admin/category_sortUp/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning mx-1">⇧</a>
                            <a href="{{ url('/admin/category_sortDown/?sort_no=' . $category->sort_no . '&hierarchy='  . $category->hierarchy .'') }}" class="btn btn-warning mx-1">⇩</a>
                        @endif
                        <a href="{{ route( 'category.edit', $category->id) }}" class="btn btn-success mx-1 align-middle">編集</a>
                        <form action="{{ route( 'category.destroy', $category->id ) }}" method="post" class="mx-1">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="削除">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
@endsection

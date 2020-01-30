@extends('layouts.admin')
@section('content')
    <form action="{{ route( 'category.store') }}" method="post" class="form-inline">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <span>@error('category_name')※@enderror</span>
            <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name') }}" required="required">
            {{--            <input type="hidden" id="parent_category_id" name="parent_category_id" value="">--}}
            <input type="hidden" id="hierarchy" name="hierarchy" value="0">
            <input class="btn btn-primary ml-1" type="submit" value="この階層にカテゴリ追加">
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                @isset($current_categories->parent_category_id))
                <th><a href="{{ route( 'category.show', ['category' => $current_categories->parent_category_id] ) }}">⇧</a>　カテゴリ</th>
                @else
                    <th><a href="{{ route( 'category.index') }}">⇧</a>　カテゴリ</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @isset($child_categories)
                @foreach ($child_categories as $category)
                    <tr>
                        <div>
                            <td><a href="{{ route( 'category.show', ['category' => $category->id] ) }}">{{ $category->category_name }}</a></td>
                        </div>
                        <div class="text-right">
                            <td class="px-0"><a href="#">編集</a></td>
                            <td class="px-0"><a href="#">並び</a></td>
                            <td class="px-0"><a href="#">削除</a></td>
                        </div>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
@endsection

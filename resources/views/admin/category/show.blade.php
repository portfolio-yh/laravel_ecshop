@extends('layouts.admin')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                @isset($find_categories->parent_category_id))
                <th><a href="{{ route( 'category.show', ['category' => $find_categories->parent_category_id] ) }}">⇧</a>　カテゴリ</th>
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

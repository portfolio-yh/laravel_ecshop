<?php

//use App\Categories;

// TOP
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('TOP', route('admin.home'));
});

// Home > member
Breadcrumbs::for('member.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('メンバー管理', route('member.index'));
});

// Home > category
Breadcrumbs::for('category.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('カテゴリ管理', route('category.index'));
});

// Home > category > [Category]
Breadcrumbs::for('category.show', function ($trail) {
    $trail->parent('category.index');

    $id = Route::getCurrentRoute()->category;
    $find = App\Categories::find($id, ['id','parent_category_id','category_name']);
    $reversed_array = [];
    while ($find) {
        array_push($reversed_array, [
            'name' => $find->category_name,
            'url' => route('category.show', $find->id)
        ]);
        $find = App\Categories::find($find->parent_category_id, ['id','parent_category_id','category_name']);
    }
    foreach (array_reverse($reversed_array) as $item) {
        $trail->push($item['name'], $item['url']);
    }



});

Breadcrumbs::for('admin.login', function ($trail) {
    $trail->push('Title Here', route('admin.login'));
});

Breadcrumbs::for('login', function ($trail) {
    $trail->push('Title Here', route('login'));
});

Breadcrumbs::for('category.destroy', function ($trail) {
    $trail->push('Title Here', route('category.destroy'));
});

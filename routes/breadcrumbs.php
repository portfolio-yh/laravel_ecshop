<?php

// TOP
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('TOP', route('admin.home'));
});

// Home > member
Breadcrumbs::for('member.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('メンバー管理', route('member.index'));
});

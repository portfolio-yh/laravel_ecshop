@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">メンバー一覧</div>
    <div class="card-body">
        <a href="{{ route("member.create") }}">メンバー作成</a>
    </div>
</div>
@endsection


@extends('admin.common.layout2')

@section('title', 'カテゴリーの編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.category.index', '商品カテゴリー一覧') }}</li>
        <li><a href="add.html">更新登録</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">商品カテゴリーの編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.category.form')
            </div>
        </div>
    </section>
</main>
@endsection

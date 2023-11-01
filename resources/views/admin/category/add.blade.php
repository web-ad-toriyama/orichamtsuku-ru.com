
@extends('admin.common.layout2')

@section('title', '商品カテゴリーの追加')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.category.index', '商品カテゴリー一覧') }}</li>
        <li><a href="">新規登録</a></li>
    </ol>

    <section id="post_add">
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.category.form')
            </div>
        </div>
    </section>
</main>
@endsection
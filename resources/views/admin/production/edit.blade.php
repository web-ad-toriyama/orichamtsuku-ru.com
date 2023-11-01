
@extends('admin.common.layout2')

@section('title', '投稿の編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.production.index', '投稿一覧') }}</li>
        <li><a href="add.html">更新登録</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">投稿の編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.production.form')
            </div>
        </div>
    </section>
</main>
@endsection

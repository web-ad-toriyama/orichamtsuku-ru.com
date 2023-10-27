
@extends('admin.common.layout2')

@section('title', 'お知らせの編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.news.index', 'お知らせ一覧') }}</li>
        <li><a href="">更新登録</a></li>
    </ol>
    <section id="news_add">
        <h2 class="hidden">お知らせの編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.news.form')
            </div>
        </div>
    </section>
</main>
@endsection

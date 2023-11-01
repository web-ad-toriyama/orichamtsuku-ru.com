
@extends('admin.common.layout2')

@section('title', '商品の追加')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.template.index', '商品一覧') }}</li>
        <li><a href="">新規登録</a></li>
    </ol>

    <section id="post_add">
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.template.form')
            </div>
        </div>
    </section>
</main>
@endsection

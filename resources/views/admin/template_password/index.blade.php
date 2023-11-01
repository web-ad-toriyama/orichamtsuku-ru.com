@extends('admin.common.layout')

@section('title', '会社情報')

@section('contents')
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a href="">パスワード</a></li>
        </ol>
        @include('admin.common.validation_error')
        <div class="wrapper">
            <h3>パスワード</h3>
            <div class="innerwrap">
                {{ Form::open() }}
                <ul class="form_wrapper max600">
                    <li>
                        <label for="name" class="ttl_min ic_required">パスワード</label>
                        <div class="input_wrapper">
                            {{ Form::text('password', $company->password ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="tel" class="ttl_min ic_required">パスワード確認</label>
                        <div class="input_wrapper">
                            {{ Form::text('password_confirmation', $company->password_confirmation ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>

                </ul>
                <div class="fix_bt">
                    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</main>
@endsection

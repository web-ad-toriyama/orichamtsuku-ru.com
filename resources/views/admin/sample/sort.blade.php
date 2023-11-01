@extends('admin.common.layout')

@section('title', '商品一覧並び替え')

@section('contents')
{{ Form::open(['route'=>'wb-admin.sample.sort']) }}
<main class="main_top">
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.sample.index', '商品一覧') }}</li>
        <li>並び替え</li>
    </ol>
    <section id="post_list">
        <div class="wrapper">
            <p class="font_annot_12">プルダウンからカテゴリーごとの並び替えができます</p>
            <div class="select_box ma">
                {{Form::select('category', $categories, $category_id, ['id'=>'sel_category', 'class'=>'is-empty'])}}
            </div>
            <div class="innerwrap">
            @if ($posts->count() > 0)
                <ul id="items" class="list_card">
                    @foreach ($posts as $post)
                    <li>
                        <label for="post0{{ $post->id }}">
                            <div class="list_box">
                                <div class="img_box">
                                    <img src="{{ Storage::disk('post')->url($post->file_path1) }}">
                                </div>
                                <div class="list_ttl">
                                    {{Form::input('hidden', 'id[]', $post->id)}}
                                    @if ($post->display == config('custom.display.on'))
                                        <label class="tgl_bt display"><span>表示中</span></label>
                                    @else
                                        <label class="tgl_bt hide"><span>非表示</span></label>
                                    @endif
                                    <b>{{ $post->name }}</b>
                                </div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <div class="spacer_340"></div>
            @else
                <p class="ta_center text">商品はまだありません</p>
            @endif
            </div>
        </div>
    </section>
    <div class="fix_bt">
        <button type="submit" class="bt_center add">
            <span class="material-icons">sort</span>並び順を保存する
        </button>
    </div>
</main>
{{ Form::close() }}
@endsection

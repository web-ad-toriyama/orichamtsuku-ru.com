@extends('admin.common.layout')

@section('title', '商品一覧')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>商品一覧</li>
    </ol>
    <div class="bt_top">
        <div class="bt">
            <a class="bt_more add" href="{{ url('wb-admin/sample/add') }}">
                <span class="material-icons">add_circle_outline</span>追加する
            </a>
            <a class="bt_more sort" href="{{ url('wb-admin/sample/sort') }}">
                <span class="material-icons">sort</span>並び替える
            </a>
            <button type="submit" class="bt_more delete" disabled>
                <span class="material-icons">delete</span>まとめて削除する
            </button>
        </div>
    </div>

    <section id="post_list">
        <h2 class="hidden">商品一覧</h2>
        <div class="wrapper">
            <div class="innerwrap">

            @foreach ($posts as $category => $post)
                <h3 class="ca_name">{{$category}}</h3>
                @if ($post->count() > 0)
                    <ul class="list_card">
                    @foreach ($post as $item)
                        <li>
                            <label for="post0{{ $item->id }}">
                                <input type="checkbox" name="del[]" id="post0{{ $item->id }}" class="check_delete" value="{{ $item->id }}" disabled>
                                <div class="list_box">
                                    <div class="img_box">
                                        <img src="{{ Storage::disk('post')->url($item->file_path1) }}">
                                    </div>
                                    <div class="list_ttl">
                                        @if ($item->display == config('custom.display.on'))
                                            <label class="tgl_bt display"><span>{{ link_to_route('wb-admin.sample.display', '表示中', $item->id) }}</span></label>
                                        @else
                                            <label class="tgl_bt hide"><span>{{ link_to_route('wb-admin.sample.display', '非表示', $item->id) }}</span></label>
                                        @endif
                                        <b>{{ $item->name }}</b>
                                    </div>
                                    <p class="font_annot_12">
                                        {!! removalImageTag($item->contents) !!}
                                    </p>
                                    <div class="bt">
                                        <a class="bt_edit" href="{{ url('wb-admin/sample/edit/'.$item->id) }}">
                                            <span class="material-icons">edit</span>編集する
                                        </a>
                                    </div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                    </ul>
                @else
                    <p class="ta_center text">{{$category}}の商品が登録されていません</p>
                @endif
            @endforeach
            </div>
        </div>
    </section>
    <div class="fix_bt">
        <a class="bt_center add" href="{{ url('wb-admin/sample/add') }}">
            <span class="material-icons">add_circle_outline</span>追加する
        </a>
        <button type="submit" class="bt_center delete" disabled>
            <span class="material-icons">delete</span>まとめて削除する
        </button>
        <input type="checkbox" id="choice" class="bt_choice">
        <label for="choice" class="choice">削除選択</label>
        <label for="choice" class="cancel">キャンセル</label>
    </div>
</main>
{{ Form::close() }}
@endsection

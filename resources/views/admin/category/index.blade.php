@extends('admin.common.layout')

@section('title', 'カテゴリー一覧')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>カテゴリー一覧</li>
    </ol>
    <div class="bt_top">
        <div class="bt">
            <a class="bt_more add" href="{{ url('wb-admin/category/add') }}">
                <span class="material-icons">add_circle_outline</span>追加する
            </a>
            <a class="bt_more sort" href="{{ url('wb-admin/category/sort') }}">
                <span class="material-icons">sort</span>並び替える
            </a>
            <button type="submit" class="bt_more delete delete_category" disabled>
                <span class="material-icons">delete</span>まとめて削除する
            </button>
        </div>
    </div>

    <section id="post_list">
        <h2 class="hidden">投稿一覧</h2>
        <div class="wrapper">
            <div class="innerwrap">
            @if ($categories->count() > 0)
                <ul class="list_card">
                    @foreach ($categories as $category)
                    <li>
                        <label for="post0{{ $category->id }}">
                            @if ($category->id != 1)
                            <input type="checkbox" name="del[]" id="post0{{ $category->id }}" class="check_delete" value="{{ $category->id }}" disabled>
                            @endif
                            <div class="list_box">
                                <div class="list_ttl">
                                    @if ($category->display == config('custom.display.on'))
                                    <label class="tgl_bt display"><span>{{ link_to_route('wb-admin.category.display', '表示中', $category->id.'?page='.request('page')) }}</span></label>
                                    @else
                                    <label class="tgl_bt hide"><span>{{ link_to_route('wb-admin.category.display', '非表示', $category->id.'?page='.request('page')) }}</span></label>
                                    @endif
                                    <b>{{ $category->name }}</b>
                                </div>
                                <div class="date font_annot_12">{{ $category->published_at }}</div>

                                <div class="bt">
                                    @if ($category->id != 1)
                                    <a class="bt_edit" href="{{ url('wb-admin/category/edit/'.$category->id) }}">
                                        <span class="material-icons">edit</span>編集する
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </label>
                    </li>
                    <input type="hidden" id="related_flg{{ $category->id }}" value="{{ $category->related_flg }}">
                    @endforeach
                </ul>
                <div class="spacer_340"></div>
            @else
                <p class="ta_center text">投稿はまだありません</p>
            @endif
            </div>
        </div>
    </section>
    {{-- ページネーション --}}
    {{ $categories->links('vendor.pagination.default') }}
    <div class="fix_bt">
        <a class="bt_center add" href="{{ url('wb-admin/post/add') }}">
            <span class="material-icons">add_circle_outline</span>追加する
        </a>
        <button type="submit" class="bt_center delete delete_category" disabled>
            <span class="material-icons">delete</span>まとめて削除する
        </button>
        <input type="checkbox" id="choice" class="bt_choice">
        <label for="choice" class="choice">削除選択</label>
        <label for="choice" class="cancel">キャンセル</label>
    </div>
</main>
{{ Form::close() }}
@endsection

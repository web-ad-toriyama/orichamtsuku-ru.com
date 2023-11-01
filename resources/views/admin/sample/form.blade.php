{{ Form::open(['enctype'=>'multipart/form-data']) }}
@include('admin.common.validation_error')
<meta name="csrf-token" content="{{ csrf_token() }}">
<ul class="form_wrapper max600">
    <li>
        <label for="title" class="ttl_min ic_required">カテゴリー選択</label>
        <div class="select_box">
            {{Form::select('category_id', $categories, $post->category_id ?? '',['class'=>'is-empty'])}}
        </div>
        <div class="cl"></div>
    </li>
    <li>
        <label for="title" class="ttl_min ic_required">商品名</label>
        <div class="input_wrapper">
            {{ Form::text('name', $post->name ?? '') }}
        </div>
        <div class="cl"></div>
    </li>

    <li>
        <b class="ttl_min ic_required">商品画像1</b>
        <p class="font_annot_12">商品一覧に表示される画像です。</p>
        <div class="upload_box">
            <label class="file_up" for="bt_file1">
                <div class="preview_box">
                    @if ($post->file_path1 ?? '')
                        <img class="preview_img" src="{{ Storage::disk('post')->url($post->file_path1) }}" alt="">
                    @endif
                </div>
                <p class="file_up_text"><span class="material-icons">photo_camera</span>画像を選択する</p>
                {{ Form::file('file1', ['id'=>'bt_file1','accept'=>'image/*','onchange'=>'loadImage(this);']) }}
                {{ Form::hidden('file_path1', ($post->file_path1 ?? '')) }}
            </label>
        </div>
        <div class="cl"></div>
    </li>
</ul>
<div class="fix_bt">
    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
</div>
{{ Form::close() }}

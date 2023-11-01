{{ Form::open(['enctype'=>'multipart/form-data']) }}
@include('admin.common.validation_error')
<ul class="form_wrapper max600">
    <li>
        <label for="title" class="ttl_min ic_required">カテゴリー名</label>
        <div class="input_wrapper">
            {{ Form::text('name', $category->name ?? '') }}
        </div>
        <div class="cl"></div>
    </li>
</ul>
<div class="fix_bt">
    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
</div>
{{ Form::close() }}

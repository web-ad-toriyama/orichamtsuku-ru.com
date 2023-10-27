@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_9">

    <div class="subvisual">
      <h2>
        タイトルが入ります。
      </h2>
    </div>

    <div class="inner spacing">
    <!-- ここからページによって異なるコンテンツ部分 -->
      <section class="sec">

        <div class="secondary_title">
          <h3>
            h:3見出しが入ります
          </h3>
        </div>

        {{-- 🍆エラーはここでまとめて出力しているのでエラー表示の装飾をお願いします --}}
        @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>※{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        {{-- 🍆フォームのスタイルの修正をお願いします --}}
        {{ Form::open(['route'=>config('custom.page.contact_confirm.route')]) }}

          <div class="item">
            <label class="label" for="name">お名前</label>
            <div>
              {{ Form::text('contact_name', null, ['class'=>'inputs']) }}
            </div>
          </div>

          <div class="item">
            <label class="label" for="email">メールアドレス</label>
            <div>
              {{ Form::email('contact_email', null, ['class'=>'inputs']) }}
            </div>
          </div>

          <div class="item">
            <label class="label" for="email">メールアドレス<br>確認用</label>
            <div>
              {{ Form::email('contact_email_confirmation', null, ['class'=>'inputs']) }}
            </div>
          </div>

          <div class="item">
            <label class="label" for="tel">電話番号</label>
            <div>
              {{ Form::tel('contact_tel', null, ['class'=>'inputs']) }}
            </div>
          </div>

          <div class="item">
            <label class="label">お問い合わせ<br>用件</label>
            <div class="inputs">
            @foreach (config('custom.icon.requirement') as $key => $value)
            <div class="contact_item">
            {{ Form::radio('contact_requirement', $key, null, ['id'=>'requirement_'.$key]) }}
            <label for="requirement_{{ $key }}">{{ $value }}</label><br>
            </div>
            @endforeach
            </div>
          </div>

          <div class="item">
            <label class="label" for="comment">お問い合わせ<br>内容</label>
            <div>
              {{ Form::textarea('contact_contents', null, ['class'=>'inputs', 'rows'=>8]) }}
            </div>
          </div>

          <div class="btn_area">
            <input type="submit" value="送信内容を確認する"><input type="reset" value="リセット">
          </div>

        {{ Form::close() }}
      </section>
    <!-- //ここまでページによって異なるコンテンツ部分 -->
    </div>


  </main>
<!-- //ここまでmain ********************************************************************************-->

@endsection

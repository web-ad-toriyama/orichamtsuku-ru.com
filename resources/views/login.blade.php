@extends('common.layout')

@section('main')
    <!-- ここからmain ********************************************************************************-->
    <main class="index_10">

        <div class="subvisual">
            <h2>
                タイトルが入ります。
            </h2>
        </div>
        <div class="inner spacing">
            <!-- ここからページによって異なるコンテンツ部分 -->
            <section class="sec">
                {{ Form::open() }}



                {{-- バリデーション エラーメッセージ --}}
                @if ($errors->any())
                    <ul class="err_box">
                        @foreach ($errors->all() as $error)
                            <li class="form_err_msg">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="box_form">
                    <label class="form_label" for="password">パスワード</label>
                    {{ Form::password
                        ('password',
                            [
                            'id'=>'password', 'class'=>'form_control'
                            ]
                        )
                    }}
                </div>

                <div class="box_form">
                    <label class="check_pass" for="check_pass">
                        {{ Form::checkbox
                            ('display', null, false,
                                [
                                'id'=>'check_pass', 'class'=>'form_control',
                                ]
                            )
                        }}パスワードを表示する
                    </label>
                </div>

                <div class="box_form">
                    {{ Form::button
                        ('ログイン',
                            [
                            'type'=>'submit',
                            ]
                        )
                    }}
                </div>


                {{ Form::close() }}

            </section>
            <!-- //ここまでページによって異なるコンテンツ部分 -->
        </div>

    </main>
    <!-- //ここまでmain ********************************************************************************-->
@endsection

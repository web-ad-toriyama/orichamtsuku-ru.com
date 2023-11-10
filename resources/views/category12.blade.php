@extends('common.layout')

@section('main')

    <!-- ここからmain ********************************************************************************-->
    <main class="index_6">

        <div class="subvisual">
            <h2>タイトルが入ります。</h2>
        </div>

        <div class="inner spacing">
            <!-- ここからページによって異なるコンテンツ部分 -->
            <section class="sec">

                <div class="secondary_title">
                    <h3>h:3見出しが入ります</h3>
                </div>
                {{Form::select('category_id', $select, $category_id ?? '',['class'=>'is-empty'])}}
                <div class="box">
                    @foreach ($samples as $post)
                        <section>
                            <article>
{{--                                <a href="{{ url(config('custom.page.category3_detail.url').'/'.$post->id) }}">--}}
                                    <p>
                                        @if(isset($post->file_path1))
                                            <img src="{{ Storage::disk('post')->url($post->file_path1) }}" alt="{{ $post->title }}" loading="lazy" height="300" width="400">
                                        @else
                                            <img src="{{ Storage::disk('post')->url('noimage_post.jpg') }}" alt="{{ $post->title }}" loading="lazy" height="300" width="400">
                                        @endif
                                    </p>
                                    <h3>{{ $post->name }}</h3>
                                    <time>{{ \Carbon\Carbon::parse($post->published_at)->format('Y.m.d H:i') }}</time>
                                    <div class="stickarrow"></div>
{{--                                </a>--}}
                            </article>
                        </section>
                    @endforeach
                </div>

                {{-- 🍆ページネーションの現在地の装飾をお願いします --}}
                {{ $samples->links('vendor.pagination.official') }}

            </section>
            <!-- //ここまでページによって異なるコンテンツ部分 -->
        </div>

        <script>
            $('select').change(function() {
                window.location.href = '/samples/'+$(this).val();
            });
        </script>
    </main>
    <!-- //ここまでmain ********************************************************************************-->
@endsection

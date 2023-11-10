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
                <div class="box">
                    @foreach ($voices as $post)
                        <section>
                            <article>
{{--                                <a href="{{ url(config('custom.page.category3_detail.url').'/'.$post->id) }}">--}}
                                    <p>
                                        @if(isset($post->file_path))
                                            <img src="{{ Storage::disk('post')->url($post->file_path) }}" alt="{{ $post->title }}" loading="lazy" height="300" width="400">
                                        @else
                                            <img src="{{ Storage::disk('post')->url('noimage_post.jpg') }}" alt="{{ $post->title }}" loading="lazy" height="300" width="400">
                                        @endif
                                    </p>
                                    <h3>{{ $post->title }}</h3>
                                    <time>{{ \Carbon\Carbon::parse($post->published_at)->format('Y.m.d H:i') }}</time>
                                    <div class="text">{!! $post->contents !!}</div>
                                    <div class="stickarrow"></div>
{{--                                </a>--}}
                            </article>
                        </section>
                    @endforeach
                </div>

                {{-- 🍆ページネーションの現在地の装飾をお願いします --}}
                {{ $voices->links('vendor.pagination.official') }}

            </section>
            <!-- //ここまでページによって異なるコンテンツ部分 -->
        </div>

    </main>
    <!-- //ここまでmain ********************************************************************************-->
@endsection

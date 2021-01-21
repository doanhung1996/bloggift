@extends('layouts.app')
@push('styles')
    <style>
        .sh-section__head{
            padding-bottom: 10px;
        }

        .sh-section__content{
            padding-top: 0px;
            padding-bottom: 0px;
        }

        audio, canvas, progress, video{
            outline: none;
        }
    </style>
@endpush
@section('content')
    <main>
        <div class="container">
            <div class="sh-content-head sh-content-head__flex-off">
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="sh-section">
                        <div class="sh-section__head">
                            <a href="#" class="sh-section__avatar sh-avatar"><img src="/blog/images/avatars/avatar-02.png" alt=""></a>
                            <div>
                                <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="#" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
                        </div>
                        <div class="sh-section__content">
                            <div>
                                <video controls crossorigin playsinline poster="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" style="width: 100%;">
                                    {{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">--}}
                                    {{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">--}}
{{--                                    @if(auth()->user()->status_payment == 1)--}}
{{--                                        <source src="{{ $post->video }}" type="video/mp4">--}}
                                        <source src="{{ $post->video }}" type="video/mp4">
{{--                                    @endif--}}
                                </video>
                                {!! $post->body !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sh-aside">
                        <p style="padding: 15px 0px;">Bài viết mới nhất !</p>
                        @foreach($postNews as $postNew)
                            @if($postNew->type == \App\Enums\TypePost::VIDEO)
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <a href="#" class="sh-section__avatar sh-avatar"><img src="/blog/images/avatars/avatar-06.png" alt=""></a>
                                        <div>
                                            <a href="{{ $postNew->url() }}" class="sh-section__name">{{ $postNew->title }}</a>
                                            <span class="sh-section__passed">{{ $postNew->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        {{--                                        <small>{!! $postNew->description !!}</small>--}}
                                        <div class="sh-section__media sh-video">
                                            <div class="sh-video__player">
                                                <iframe width="100%" height="300px" src="{{ $postNew->video }}"
                                                        frameborder="0" allow="accelerometer; autoplay;
                                            encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                        <script>
                                            require(['app'], function () {
                                                require(['modules/player']);
                                            });
                                        </script>
                                    </div>
                                    <div class="sh-section__footer">
                                        <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            @elseif($postNew->type == \App\Enums\TypePost::TEXT)
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $postNew->url() }}" class="sh-section__name">{{ $postNew->title }}</a>
                                            <span class="sh-section__passed">{{ $postNew->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <p>{!! $postNew->text !!}</p>
                                    </div>
                                    <div class="sh-section__footer">
                                        <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            @elseif($postNew->type == \App\Enums\TypePost::IMAGE)
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $postNew->url() }}" class="sh-section__name">{{ $postNew->title }}</a>
                                            <span class="sh-section__passed">{{ $postNew->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__image">
                                            <a href="{{ $postNew->url() }}"><img src="{{ $postNew->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="sh-section__footer">
                                        <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            @elseif($postNew->type == \App\Enums\TypePost::FILE)
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $postNew->url() }}" class="sh-section__name">{{ $postNew->title }}</a>
                                            <span class="sh-section__passed">{{ $postNew->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <p><a href="{{ $post->getFirstMediaUrl('file') }}" target="_blank">Xem tài liệu</a></p>
                                    </div>
                                    <div class="sh-section__footer">
                                        <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection

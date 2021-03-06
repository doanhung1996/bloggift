@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="sh-content-head">
                Đây là trang danh mục {{ $category->name ?? null }}
            </div>
            <div class="sh-section__wrap row">
                @if($posts->count() == 0)
                    <div class="text-center col-12">
                        <p>Chưa có bài viết nào !</p>
                    </div>
                @else
                    @foreach($posts as $post)
                        @if($post->type == \App\Enums\TypePost::VIDEO)
                            <div class="sh-section__item col-lg-6">
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <a href="#" class="sh-section__avatar sh-avatar"><img src="/blog/images/avatars/avatar-06.png" alt=""></a>
                                        <div>
                                            <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                            <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__media sh-video">
                                            <div class="sh-video__player">
                                                <iframe width="100%" height="390px" src="{{ $post->video }}"
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
                            </div>
                        @elseif($post->type == \App\Enums\TypePost::TEXT)
                            <div class="sh-section__item col-lg-6">
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                            <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__image">
                                            <a href="{{ $post->url() }}"><img src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" alt=""></a>
                                        </div>
                                        <div>{!! $post->text !!}</div>
                                    </div>
                                    <div class="sh-section__footer">
                                       <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            </div>
                        @elseif($post->type == \App\Enums\TypePost::IMAGE)
                            <div class="sh-section__item col-lg-6">
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                            <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__image">
                                            <a href="{{ $post->url() }}"><img src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="sh-section__footer">
                                       <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            </div>
                        @elseif($post->type == \App\Enums\TypePost::FILE)
                            <div class="sh-section__item col-lg-6">
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <div>
                                            <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                            <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__image">
                                            <a href="{{ $post->url() }}"><img src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" alt=""></a>
                                        </div>
                                        <p><a href="{{ $post->getFirstMediaUrl('file') }}" target="_blank">Xem tài liệu</a></p>
                                    </div>
                                    <div class="sh-section__footer">
                                       <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            </div>
                        @elseif($post->type == \App\Enums\TypePost::LESSON)
                            <div class="sh-section__item col-lg-6">
                                <div class="sh-section">
                                    <div class="sh-section__head">
                                        <a href="#" class="sh-section__avatar sh-avatar"><img src="/blog/images/avatars/avatar-06.png" alt=""></a>
                                        <div>
                                            <a href="{{ $post->url() }}" class="sh-section__name">{{ $post->title }}</a>
                                            <span class="sh-section__passed">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                    </div>
                                    <div class="sh-section__content">
                                        <div class="sh-section__image">
                                            <a href="{{ $post->url() }}"><img src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg' }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="sh-section__footer">
                                       <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </main>
    <!-- FOOTER -->
    <footer>
        <div class="sh-footer load-more @if($posts->count() == 0) hide @endif">
            <a href="javascript:void(0);" data-url="{{ route('post.load.more.post', $category->slug) }}" id="load-more" class="sh-footer__more-btn">
                <span class="icon-Scroll_Down"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                <p>Tải thêm</p>
            </a>
            <a href="javascript:void(0);" class="btn btn-border01 hide" id="no-item-load-more">Đã hiển thị tất cả bài viết</a>
        </div>
    </footer>
@endsection

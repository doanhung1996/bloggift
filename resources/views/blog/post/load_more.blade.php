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
                    <a href="{{ $post->url() }}" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
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
                    <a href="{{ $post->url() }}" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
                </div>
                <div class="sh-section__content">
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
                    <a href="{{ $post->url() }}" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
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
                    <a href="{{ $post->url() }}" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
                </div>
                <div class="sh-section__content">
                    <p><a href="{{ $post->getFirstMediaUrl('file') }}" target="_blank">Xem tài liệu</a></p>
                </div>
                <div class="sh-section__footer">
                   <a href="{{ $post->url() }}" class="sh-section__btn-stat sh-btn-icon" title="Lượt xem">{{ $post->view }} lượt xem</a>
                </div>
            </div>
        </div>
    @endif
@endforeach

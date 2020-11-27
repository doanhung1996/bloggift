<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Sharehub - Responsive HTML5 Template">
    <meta name="author" content="SH">
    <title>Marketing Studies</title>

    <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('blog/fonts/icons/fontawesome/css/font-awesome.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('blog/fonts/icons/sharehub/style.css')}}"/>

    <link rel="stylesheet" href="{{ asset('blog/vendor/css/magnific-popup.css')}}" type="text/css" />
    <link href="{{ asset('blog/css/style.css')}}" rel="stylesheet"/>

    <script data-main="js/app" src="{{ asset('blog/vendor/js/jquery/jquery.min.js')}}"></script>
    <script data-main="js/app" src="{{ asset('blog/vendor/js/require.js')}}"></script>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <link rel="stylesheet" href="{{ asset('blog/vendor/css/datepicker.css')}}"/>
    <style>
        .hide{
            display: none
        }
    </style>
</head>
<body>
<!-- HEADER -->
<header>
    <div class="sh-header">
        <div class="container">
            <a href="{{ route('home') }}" class="sh-logo">
                <img src="/blog/images/logo.png" alt="">
                <img src="/blog/images/logo.png" alt="">
            </a>
            <script>
                require(['app'], function () {
                    require(['modules/menu']);
                });
            </script>
            <nav>
                <ul class="sh-header__menu">
                    <li class="active"><a href="/">Trang chủ</a></li>
                    @if($pageTaxons->isNotEmpty())
                        @foreach($pageTaxons as $page)
                            <li class="active">
                                <a href="{{ $page->urlPage() }}">{{ $page->title }}</a>
                            </li>
                        @endforeach
                    @endif
                    @if($menuTaxons->isNotEmpty())
                        @foreach($menuTaxons as $taxon)
                            <li class="active">
                                <a href="{{ $taxon->urlPost() }}">{{ $taxon->name }}</a>
                                <div class="sh-header__nav">
                                    <div class="container">
                                        <ul>
                                            @foreach($taxon->childs as $child)
                                                <li><a href="{{ $child->urlPost() }}">{{ $child->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
            <div class="sh-header__search">
                <form action="" method="GET">
                    <label>
                        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm kiếm bài viết">
                        <i class="icon-Search"></i>
                    </label>
                </form>
            </div>
            <script>
                require(['app'], function () {
                    require(['modules/userToggle']);
                });
            </script>
        </div>
    </div>

    <script>
        require(['app'], function () {
            require(['modules/main']);
            require(['modules/upload']);
        });
    </script>
</header>
<script>
    /*----------------------------------------*/
    /*      Load More Post
    /*----------------------------------------*/
    var pagePost = 1,
        finalPagePost = false ;
    $(document).ready(function() {
        $(document).on('click', '#load-more',function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var $this = $(this);
            if (!$this.data("loading")) {
                $this.addClass('btn-loading');
                $this.attr('disabled', true);
                $this.data("loading", true);
                pagePost += 1;
                $.ajax({
                    type: 'GET',
                    url: url + '?page=' + pagePost,
                    data : {
                      'q' : '{{ request('q') }}'
                    },
                    success(data) {
                        $this.removeClass('btn-loading');
                        $this.removeAttr('disabled', true);
                        $this.removeData("loading");
                        var $data = $(data.view);
                        $data.hide();
                        $('#list-post').append($data);
                        $data.fadeIn();
                        if (data.is_last_page_post == true) {
                            finalPagePost = true;
                            $('#load-more').addClass('hide');
                            $('#no-item-load-more').removeClass('hide');
                        }
                    },
                });
            }
        });
    });
</script>
@yield('content')
</body>
</html>

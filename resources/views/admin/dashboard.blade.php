@extends('admin.layouts.master')

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-cube mr-2"></i> <span class="font-weight-semibold">{{ __('Trang chủ') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop
@push('css')
    <link rel="stylesheet" href="/admin/global_assets/js/vendors/vector-map/jquery-jvectormap-2.0.5.css">
@endpush

{{--@push('js')--}}
{{--    <script src="/admin/global_assets/js/vendors/vector-map/jquery-jvectormap-2.0.5.min.js"></script>--}}
{{--    <script src="/admin/global_assets/js/vendors/vector-map/jquery-jvectormap-world-mill.js"></script>--}}
{{--    <script src="/admin/global_assets/js/vendors/echarts/echarts.min.js"></script>--}}
{{--    <script !src="">--}}
{{--        $.ajaxSetup({ cache: false });--}}
{{--        $(function () {--}}
{{--            $('.card [data-action=reload]:not(.disabled)').on('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                var $target = $(this),--}}
{{--                    block = $target.closest('.card');--}}

{{--                // Block card--}}
{{--                $(block).block({--}}
{{--                    message: '<i class="icon-spinner2 spinner"></i>',--}}
{{--                    overlayCSS: {--}}
{{--                        backgroundColor: '#fff',--}}
{{--                        opacity: 0.8,--}}
{{--                        cursor: 'wait',--}}
{{--                        'box-shadow': '0 0 0 1px #ddd'--}}
{{--                    },--}}
{{--                    css: {--}}
{{--                        border: 0,--}}
{{--                        padding: 0,--}}
{{--                        backgroundColor: 'none'--}}
{{--                    }--}}
{{--                });--}}
{{--                let url = $(block).data('url');--}}
{{--                $.get(url, function(response, status){--}}
{{--                    $(block).find('.card-body').html(response);--}}
{{--                    $(block).unblock();--}}
{{--                });--}}
{{--            });--}}

{{--            $('.ajax-card').each(function (index, el) {--}}
{{--                $(this).block({--}}
{{--                    message: '<i class="icon-spinner2 spinner"></i>',--}}
{{--                    overlayCSS: {--}}
{{--                        backgroundColor: '#fff',--}}
{{--                        opacity: 0.8,--}}
{{--                        cursor: 'wait',--}}
{{--                        'box-shadow': '0 0 0 1px #ddd'--}}
{{--                    },--}}
{{--                    css: {--}}
{{--                        border: 0,--}}
{{--                        padding: 0,--}}
{{--                        backgroundColor: 'none'--}}
{{--                    }--}}
{{--                });--}}
{{--                let $this = $(this);--}}

{{--                let url = $(el).data('url');--}}
{{--                $.get(url, function(response, status){--}}
{{--                    $(el).find('.card-body').html(response);--}}
{{--                    $this.unblock();--}}
{{--                });--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

@section('page-content')
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-indigo-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-0">{{ formatNumber($totalPosts) }}</h3>
                        <span class="text-uppercase font-size-xs">{{ 'Bài viết' }}</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-users4 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card ajax-card" data-url="{{ route('admin.analytics') }}">--}}
{{--                <div class="card-header header-elements-inline">--}}
{{--                    <h6 class="card-title"><i class="icon-chart mr-2"></i> {{ __('Phân tích') }}</h6>--}}
{{--                    <div class="header-elements">--}}
{{--                        <div class="list-icons">--}}
{{--                            <a class="list-icons-item" data-action="collapse"></a>--}}
{{--                            <a class="list-icons-item" data-action="reload"></a>--}}
{{--                            <a class="list-icons-item" data-action="remove"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card-body">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="card ajax-card" data-url="{{ route('admin.top-referrers') }}">--}}
{{--                <div class="card-header header-elements-inline">--}}
{{--                    <h6 class="card-title"><i class="icon-eye8 mr-2 "></i>{{ __('Tìm kiếm hàng đầu') }}</h6>--}}
{{--                    <div class="header-elements">--}}
{{--                        <div class="list-icons">--}}
{{--                            <a class="list-icons-item" data-action="collapse"></a>--}}
{{--                            <a class="list-icons-item" data-action="reload"></a>--}}
{{--                            <a class="list-icons-item" data-action="remove"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card-body">--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-md-6">--}}
{{--            <div class="card ajax-card" data-url="{{ route('admin.most-visited-pages') }}">--}}
{{--                <div class="card-header header-elements-inline">--}}
{{--                    <h6 class="card-title"><i class="icon-eye8 mr-2 "></i>{{ __('Trang truy cập nhiều nhất') }}</h6>--}}
{{--                    <div class="header-elements">--}}
{{--                        <div class="list-icons">--}}
{{--                            <a class="list-icons-item" data-action="collapse"></a>--}}
{{--                            <a class="list-icons-item" data-action="reload"></a>--}}
{{--                            <a class="list-icons-item" data-action="remove"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card-body">--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop

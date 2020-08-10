@extends('admin.layouts.master')

@section('title', __('Tạo bài viết'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">{{ __('Tạo bài viết') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.posts._form', [
        'url' =>  route('admin.posts.store'),
        'post' => new \App\Domain\Post\Models\Post,
    ])
@stop

@push('js')
    <script>
        $('.form-check-input-styled').uniform();
    </script>
    <script src="{{ asset('js/editor-admin.js') }}"></script>
@endpush


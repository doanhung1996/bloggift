@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $post->title]))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $post->title]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.posts._form', [
        'url' =>  route('admin.posts.update', $post),
        'post' => $post ?? new \App\Domain\Post\Models\Post,
        'method' => 'PUT'
    ])
@stop
@push('js')
    <script>
        $('.form-check-input-styled').uniform();
    </script>
    <script src="{{ asset('js/editor-admin.js') }}"></script>
@endpush


@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $page->title]))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people icon-2x mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $page->title]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render('admin.pages.edit', $page) }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.pages._form', [
        'url' =>  route('admin.pages.update', $page),
        'page' => $page ?? new \App\Domain\Page\Models\Page,
        'method' => 'PUT'
    ])
@stop

@push('js')
    <script src="{{ asset('js/editor-admin.js') }}"></script>
    <script>
        $('.form-check-input-styled').uniform();
    </script>
@endpush

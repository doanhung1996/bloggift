@extends('admin.layouts.master')

@section('title', __('Tạo'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-plus-circle2 icon-2x mr-2"></i> <span class="font-weight-semibold">{{ __('Tạo') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.pages._form', [
        'url' =>  route('admin.pages.store'),
        'page' => new \App\Domain\Page\Models\Page,
    ])
@stop

@push('js')
    <script src="{{ asset('js/editor-admin.js') }}"></script>
    <script>
        $('.form-check-input-styled').uniform();
    </script>
@endpush

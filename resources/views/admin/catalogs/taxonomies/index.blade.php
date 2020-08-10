@extends('admin.layouts.master')

@section('title', __('Danh mục'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-folder mr-2"></i> <span class="font-weight-semibold">{{ __('Danh mục') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    <!-- Main charts -->
    <x-card>
        {{$dataTable->table()}}
    </x-card>


@stop

@push('js')
    {{$dataTable->scripts()}}
@endpush

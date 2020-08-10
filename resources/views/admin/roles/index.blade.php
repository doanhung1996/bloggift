@extends('admin.layouts.master')

@section('title', __('Phân quyền'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-shield2 mr-2"></i> <span class="font-weight-semibold">{{ __('Phân quyền') }}</span></h4>
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

@extends('admin.layouts.master')

@section('title', __('Trang'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people icon-2x mr-2"></i> <span class="font-weight-semibold">{{ __('Trang') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    <x-card>
        {{$dataTable->table()}}
    </x-card>

@stop

@push('js')
    <script src="{{ asset('admin/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    {{$dataTable->scripts()}}
@endpush

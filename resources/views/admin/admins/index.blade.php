@extends('admin.layouts.master')

@section('title', __('Tài khoản'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people mr-2"></i> <span class="font-weight-semibold">{{ __('Tài khoản') }}</span></h4>
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
    {{$dataTable->scripts()}}
@endpush

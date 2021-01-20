@extends('admin.layouts.master')

@section('title', __('Tạo tài khoản'))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">{{ __('Tạo tài khoản') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.users._form', [
        'url' =>  route('admin.users.store'),
        'user' => new \App\Domain\User\Models\User,
    ])
@stop

@push('js')
@endpush

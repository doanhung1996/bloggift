@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $user->email]))

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $user->email]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.users._form', [
        'url' =>  route('admin.users.update', $user),
        'user' => $user ?? new \App\User,
        'method' => 'PUT'
    ])
@stop

@push('js')
@endpush

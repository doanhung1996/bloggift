@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $admin->email]))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $admin->email]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.admins._form', [
        'url' =>  route('admin.admins.update', $admin),
        'admin' => $admin ?? new \App\Domain\Admin\Models\Admin,
        'method' => 'PUT'
    ])
@stop

@push('js')
@endpush

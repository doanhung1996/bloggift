@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $role->display_name]))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $role->display_name]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop
@push('js')
    <script !src="">
        $(function () {
            $('.form-check-input-styled').uniform();
            $('.permission-group-actions > .allow-all, .permission-group-actions > .deny-all').on('click', (e) => {
                let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];
                $(e.currentTarget).closest('.permission-group')
                    .find(`.permission-${action}`)
                    .each((index, value) => {
                        $(value).prop('checked', true);
                    });
                $.uniform.update();
            });
            $('.permission-parent-actions > .allow-all, .permission-parent-actions > .deny-all').on('click', (e) => {
                let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];
                $(`.permission-${action}`).prop('checked', true);
                $.uniform.update();
            });
        })
    </script>
@endpush

@section('page-content')
    <form action="{{ route('admin.roles.update', $role) }}" method="POST" data-block>
        @csrf
        @method('PUT')
        <div class="d-flex align-items-start flex-column flex-md-row">

            <!-- Left content -->
            <div class="w-100 order-2 order-md-1 left-content">
                <div class="row">
                    <div class="col-md-12">
                        <x-card>
                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    {{ __('Chung') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#general">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                </legend>
                                <div class="collapse show" id="general">
                                    <x-text-field
                                        name="display_name"
                                        :placeholder="__('Admin, Member')"
                                        :label="__('Tên')"
                                        :value="$role->display_name"
                                    >
                                    </x-text-field>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    {{ __('Quyền') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#permissions">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                    <div class="btn-group permission-parent-actions float-right">
                                        <button type="button" class="btn btn-light allow-all">{{ __('Cho phép tất cả') }}</button>
                                        <button type="button" class="btn btn-light deny-all">{{ __('Từ chối tất cả') }}</button>
                                    </div>
                                </legend>
                                <div class="collapse show" id="permissions">
                                    @foreach($groupPermissions as $groupKey => $permissions)
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">

                                                <div class="clearfix"></div>

                                                <div class="permission-group mt-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="permission-group-head">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4">
                                                                    </div>

                                                                    <div class="col-md-8 col-sm-8">
                                                                        <div class="btn-group permission-group-actions float-right">
                                                                            <button type="button" class="btn btn-light allow-all">{{ __('Cho phép tất cả') }}</button>
                                                                            <button type="button" class="btn btn-light deny-all">{{ __('Từ chối tất cả') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                @foreach($permissions as $permission)
                                                                    <div class="permission-row">
                                                                        <div class="row">
                                                                            <div class="col-md-5 col-sm-4">
                                                                        <span class="permission-label">
                                                                            {{ $permission->display_name }}
                                                                        </span>
                                                                            </div>

                                                                            <div class="col-md-7 col-sm-8">
                                                                                <div class="form-group float-right mr-2">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <label class="form-check-label">
                                                                                            <input type="radio" {{ in_array($permission->name, $allowPermissions) ? 'checked' : null }} name="permissions[{{ $permission->name }}]" value="1" class="form-check-input-styled permission-allow" data-fouc>
                                                                                            {{ __('Cho phép') }}
                                                                                        </label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <label class="form-check-label">
                                                                                            <input type="radio" {{ !in_array($permission->name, $allowPermissions) ? 'checked' : null }} name="permissions[{{ $permission->name }}]" value="0" class="form-check-input-styled permission-deny" data-fouc>
                                                                                            {{ __('Từ chối' )}}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-center align-items-center action" id="action-form">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Trở về') }}</a>
                                <div class="btn-group ml-3">
                                    <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                                    <button class="btn bg-success dropdown-toggle" data-toggle="dropdown"></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.roles.index') }}">{{ __('Lưu và thoát') }}</a>
                                        <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.roles.create') }}">{{ __('Lưu và tạo mới') }}</a>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                    </div>
                </div>

            </div>
            <!-- /left content -->


            <!-- Right sidebar component -->
            <div class="sidebar-sticky w-100 w-md-auto order-1 order-md-2">
                <div class="sidebar sidebar-light sidebar-component sidebar-component-right sidebar-expand-md">
                    <!-- Sidebar content -->
                    <div class="sidebar-content">
                        <!-- Actions -->
                        <div class="card">
                            <div class="card-body p-0">
                                <ul class="nav nav-sidebar" data-nav-type="accordion">
                                    <li class="nav-item">
                                        <a href="#general" class="nav-link active"><i class="icon-info3"></i> {{ __('Chung') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#permissions" class="nav-link"><i class="icon-lock2"></i> {{ __('Quyền') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /actions -->

                    </div>
                    <!-- /sidebar content -->
                </div>
            </div>
            <!-- /right sidebar component -->

        </div>

    </form>
@stop

@push('js')
@endpush

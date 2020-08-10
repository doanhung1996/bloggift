@extends('admin.layouts.master')

@section('title', __('Thiết lập tài khoản'))

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-cog mr-2"></i> <span
                    class="font-weight-semibold">{{ __('Thiết lập tài khoản') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    <div class="d-md-flex align-items-md-start">

        <!-- Left sidebar component -->
        <div class="sidebar sidebar-light sidebar-component sidebar-component-left sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Sub navigation -->
                <div class="card mb-2">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Điều hướng</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar" data-nav-type="accordion">
                            <li class="nav-item">
                                <a href="#account-information" class="nav-link active" data-toggle="tab"><i class="icon-info3"></i> {{ __('Thông tin tài khoản') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#change-password" data-toggle="tab" class="nav-link"><i class="icon-lock2"></i> {{ __('Thay đổi mật khẩu') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sub navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /left sidebar component -->


        <!-- Right content -->
        <div class="w-100">
            <form action="{{ route('admin.account-settings.update') }}" method="POST" data-block enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account-information">
                        <x-card :title="__('Thông tin tài khoản')">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-right" for="first_name">
                                    <span class="text-danger">*</span>
                                    {{ __("Avatar") }} :
                                </label>
                                <div class="col-lg-9">
                                    <div class="card-img-actions d-inline-block mb-3">
                                        <img class="img-fluid rounded-circle" src="{{ $currentUser->getFirstMediaUrl('avatar') }}" width="170" height="170" alt="" id="avatar-preview">
                                        <div class="card-img-actions-overlay rounded-circle">
                                            <a href="javascript:void(0)" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 legitRipple select-file" data-input="#avatar">
                                                <i class="icon-link"></i>
                                            </a>
                                            <input type="file" class="d-none" name="avatar" id="avatar" data-preview="#avatar-preview">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-text-field required name="first_name" :label="__('Họ')" :value="$currentUser->first_name"/>
                            <x-text-field required name="last_name" :label="__('Tên')" :value="$currentUser->last_name"/>
                            <x-text-field required name="email" :label="__('Email')" type="email" :value="$currentUser->email"/>
                        </x-card>
                    </div>
                    <div class="tab-pane fade" id="change-password">
                        <x-card :title="__('Thay đổi mật khẩu')">
                            <x-text-field name="new_password" :label="__('Mật khẩu mới')" type="password"/>
                            <x-text-field name="new_password_confirmation" :label="__('Nhập lại mật khẩu')" type="password"/>
                            <x-text-field name="old_password" :label="__('Mật khẩu cũ')" type="password"/>
                        </x-card>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ __('Cập nhật') }} <i class="icon-paperplane ml-2"></i>
                    </button>
                </div>
            </form>

        </div>
        <!-- /right content -->

    </div>
@stop

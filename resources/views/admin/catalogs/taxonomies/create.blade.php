@extends('admin.layouts.master')

@section('title', __('Tạo danh mục'))

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">{{ __('Tạo danh mục') }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    <!-- Inner container -->
    <form action="{{ route('admin.taxonomies.store') }}" method="POST" data-block>
        @csrf
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
                                        name="name"
                                        :label="__('Tên')"
                                        required
                                    >
                                    </x-text-field>
                                </div>
                            </fieldset>
                        </x-card>
                        <div class="d-flex justify-content-center align-items-center action" id="action-form">
                            <a href="{{ route('admin.taxonomies.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Trở lại') }}</a>
                            <div class="btn-group ml-3">
                                <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                            </div>
                        </div>
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
        <!-- /inner container -->
    </form>

@stop

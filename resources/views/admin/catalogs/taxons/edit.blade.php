@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $taxon->name]))

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-pencil7 mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $taxon->name]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    <!-- Inner container -->
    <form action="{{ route('admin.taxons.update', $taxon) }}" method="POST" enctype="multipart/form-data" data-block>
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
                                    {{ __('General') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#general">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                </legend>

                                <div class="collapse show" id="general">
                                    <x-text-field
                                        name="name"
                                        :label="__('Tên')"
                                        :value="$taxon->name"
                                        required
                                    >
                                    </x-text-field>

                                    <x-text-field
                                        name="slug"
                                        :label="__('Slug')"
                                        :value="$taxon->slug"
                                        required
                                    >
                                    </x-text-field>
                                    <x-textarea-field
                                        name="description"
                                        :label="__('Mô tả')"
                                        :value="$taxon->description"
                                    >
                                    </x-textarea-field>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    {{ __('Ảnh') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#images">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                </legend>

                                <div class="collapse show" id="images">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right" for="icon">
                                            {{ __('Icon') }}
                                        </label>
                                        <div class="col-lg-9">
                                            <div class="card-img-actions d-inline-block" style="height: 125px; width: 125px;">
                                                <img class="img-fluid img-action" src="{{ $taxon->getFirstMediaUrl('icon') }}" id="icon-preview">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 select-file" data-input="#icon">
                                                        <i class="icon-link"></i>
                                                    </a>
                                                    <input type="file" class="d-none" name="icon" id="icon" data-preview="#icon-preview">
                                                </div>
                                            </div>
                                            @error('icon')
                                                <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    {{ __('Seo') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#seo">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                </legend>

                                <div class="collapse show" id="seo">
                                    <x-text-field
                                        name="meta_title"
                                        :label="__('Meta Title')"
                                        placeholder=""
                                        :value="$taxon->meta_title"
                                    >
                                    </x-text-field>
                                    <x-text-field
                                        name="meta_description"
                                        :label="__('Meta Description')"
                                        placeholder=""
                                        :value="$taxon->meta_description"
                                    >
                                    </x-text-field>
                                    <x-text-field
                                        name="meta_keywords"
                                        :label="__('Meta Keywords')"
                                        placeholder=""
                                        :value="$taxon->meta_keywords"
                                    >
                                    </x-text-field>
                                </div>
                            </fieldset>
                        </x-card>
                        <div class="d-flex justify-content-center align-items-center action" id="action-form">
                            <a href="{{ route('admin.taxonomies.edit', $taxon->taxonomy_id) }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Back') }}</a>
                            <div class="btn-group ml-3">
                                <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Save') }}</button>
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
                                        <a href="#general" class="nav-link active"><i class="icon-info3"></i> {{ __('General') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#images" class="nav-link"><i class="icon-image2"></i> {{ __('Images') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#seo" class="nav-link"><i class="icon-info22"></i> {{ __('Seo') }}</a>
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

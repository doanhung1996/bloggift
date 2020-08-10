@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $taxonomy->name]))

@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-pencil7 mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $taxonomy->name]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/global_assets/js/plugins/jstree/themes/default/style.min.css') }}">
    <style>
        .icon-md {
            font-size: 1.5rem;
        }
    </style>
@endpush

@push('js')
    <script>
        var adminTaxonomyPath = "{{ route('admin.taxonomies.tree', $taxonomy) }}";
    </script>
    <script src="{{ asset('admin/global_assets/js/plugins/jstree/jstree.min.js') }}"></script>
    <script !src="">
        $.jstree.defaults.core.themes.variant = "large";
        $('#taxonomy-tree').jstree({
            'core' : {
                "check_callback" : true,
                'data' : {
                    "url" : function(node) {
                        return node.id === '#'
                            ? adminTaxonomyPath : adminTaxonomyPath.replace('jstree', 'taxon') + '/' +  node.id + '/jstree'
                    },
                },

            },
            "plugins" : ['contextmenu', 'dnd', 'types'],
            "types": {
                "default": {
                    "icon": "icon-folder-open icon-md"
                }
            },
            "contextmenu": {
                items: function ($node) {
                    var tree = $('#taxonomy-tree').jstree(true);
                    return {
                        create: {
                            label: '<i class="icon-plus3 mr-2"></i> ' + Lang.create,
                            action: function (node) {
                                $node = tree.create_node($node, { text: 'New', type: 'default' });
                                tree.edit($node);
                            },
                            separator_after: false,
                            separator_before: false
                        },
                        rename: {
                            label: '<i class="icon icon-pencil mr-2"></i> ' + Lang.rename,
                            action: function (obj) {
                                tree.edit($node);
                            },
                            separator_after: false,
                            separator_before: false
                        },
                        remove: {
                            label: '<i class="icon icon-trash mr-2"></i> ' + Lang.remove,
                            action: function (obj) {
                                confirmAction(Lang.confirm_delete, function (result) {
                                    if (result) {
                                        return tree.delete_node($node)
                                    }
                                })
                            },
                            separator_after: false,
                            separator_before: false
                        },
                        edit: {
                            label: '<i class="icon-cog mr-2"></i> ' + Lang.edit,
                            action: function (obj) {
                                window.location = Admin.adminUrl('taxons/' + $node.id + '/edit');
                                return window.location
                            },
                            separator_after: false,
                            separator_before: false
                        }
                    }
                }
            },
        })
            .on('loaded.jstree', function(e, data) {
                $("#taxonomy-tree").jstree("select_node", "ul > li:first");
                let Selectednode = $("#taxonomy-tree").jstree("get_selected");
                $("#taxonomy-tree").jstree("open_node", Selectednode, false, true);
            })
            .on('delete_node.jstree', function (e, data) {
                $.ajax({
                    type: 'DELETE',
                    dataType: 'json',
                    url: Admin.adminUrl('taxons/' + data.node.id),
                })
                .fail(function () {
                    data.instance.refresh();
                });
            })
            .on('create_node.jstree', function (e, data) {
                let name = data.node.text;
                let position = data.position;
                let parent_id = data.node.parent;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: Admin.adminUrl('taxons'),
                    data: {
                        name: name,
                        position: position,
                        parent_id: parent_id,
                    }
                }).done(function (d) {
                    data.instance.set_id(data.node, d.id);
                }).fail(function () {
                    data.instance.refresh();
                });
            })
            .on('rename_node.jstree', function (e, data) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: Admin.adminUrl('taxons/' + data.node.id + '/rename'),
                    data: {
                        name: data.text,
                    }
                }).fail(function () {
                    data.instance.refresh();
                });
            })
            .on('move_node.jstree', function (e, data) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: Admin.adminUrl('taxons/' + data.node.id + '/sort'),
                    data: {
                        parent_id: data.node.parent,
                        position: data.position
                    }
                }).fail(function () {
                    data.instance.refresh();
                });
            });

    </script>
@endpush

@section('page-content')
    <!-- Inner container -->
    <form action="{{ route('admin.taxonomies.update', $taxonomy) }}" method="POST" data-block>
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
                                        name="name"
                                        :label="__('Tên')"
                                        :value="$taxonomy->name"
                                        required
                                    >
                                    </x-text-field>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    {{ __('Cây thư mục') }}
                                    <a class="text-default" data-toggle="collapse" data-target="#tree">
                                        <i class="icon-circle-down2"></i>
                                    </a>
                                </legend>

                                <div class="collapse show" id="tree">
                                    <div class="form-group">
                                        <div id="taxonomy-tree"></div>
                                    </div>
                                </div>
                                <div class="alert alert-info alert-styled-left alert-dismissible">
                                    * {{ __('Nhấp chuột phải vào một mục trong cây truy cập menu để thêm, xóa hoặc sắp xếp một mục.') }}
                                </div>
                            </fieldset>

                        </x-card>
                        <div class="d-flex justify-content-center align-items-center action" id="action-form">
                            <a href="{{ route('admin.taxonomies.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Trở lại') }}</a>
                            <div class="btn-group ml-3">
                                <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                                <button class="btn bg-success dropdown-toggle" data-toggle="dropdown"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.taxonomies.index') }}">{{ __('Lưu và thoát') }}</a>
                                    <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.taxonomies.create') }}">{{ __('Lưu và tạo mới') }}</a>
                                </div>
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
                                        <a href="#tree" class="nav-link"><i class="icon-lock2"></i> {{ __('Tree') }}</a>
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

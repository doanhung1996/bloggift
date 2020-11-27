<form action="{{ $url }}" method="POST" data-block>
    @csrf
    @method($method ?? 'POST')
    <div class="d-flex align-items-start flex-column flex-md-row">
        <!-- Left content -->
        <div class="w-100 order-2 order-md-1 left-content">
            <div class="row">
                <div class="col-md-12">
                    <x-card>
                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                {{ __('Page') }}
                                <a class="text-default" data-toggle="collapse" data-target="#general">
                                    <i class="icon-circle-down2"></i>
                                </a>
                            </legend>
                            <div class="collapse show" id="general">
                                <x-text-field
                                    name="title"
                                    :placeholder="__('Title')"
                                    :label="__('Title')"
                                    :value="$page->title"
                                    required
                                >
                                </x-text-field>
                                <x-textarea-field
                                    name="body"
                                    :placeholder="__('Content')"
                                    :label="__('Body')"
                                    :value="$page->body"
                                    required
                                    class="wysiwyg"
                                >
                                </x-textarea-field>
                                <x-check-field
                                    name="status"
                                    :label="__('Status')"
                                    :value="$page->status"
                                >
                                </x-check-field>
                            </div>
                        </fieldset>
                    </x-card>
                    <div class="d-flex justify-content-center align-items-center action" id="action-form">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Back') }}</a>
                        <div class="btn-group ml-3">
                            <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ isset($method) ? __('Update') : __('Create') }}</button>
                            <button class="btn bg-success dropdown-toggle" data-toggle="dropdown"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.admins.index') }}">{{ __('Save And Close') }}</a>
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.admins.create') }}">{{ __('Save And Create New') }}</a>
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

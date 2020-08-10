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
                                {{ __('Chung') }}
                                <a class="text-default" data-toggle="collapse" data-target="#general">
                                    <i class="icon-circle-down2"></i>
                                </a>
                            </legend>
                            <div class="collapse show" id="general">
                                <x-text-field
                                    name="first_name"
                                    :placeholder="__('Nguyễn')"
                                    :label="__('Họ')"
                                    :value="$admin->first_name"
                                    required
                                >
                                </x-text-field>

                                <x-text-field
                                    name="Tên"
                                    :placeholder="__('Văn Huy')"
                                    :label="__('Tên')"
                                    :value="$admin->last_name"
                                    required
                                >
                                </x-text-field>
                                <x-text-field
                                    name="email"
                                    :placeholder="__('nguyenhuy@gmail.com')"
                                    :label="__('Email')"
                                    type="email"
                                    :value="$admin->email"
                                    required
                                >
                                </x-text-field>

                                <x-select-field
                                    name="roles"
                                    :placeholder="__('Chọn quyền')"
                                    :options="$roles->pluck('display_name', 'id')"
                                    :label="__('Quyền')"
                                    :value="optional($admin->roles->first())->id"
                                    required
                                >

                                </x-select-field>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                {{ __('Mật khẩu') }}
                                <a class="text-default" data-toggle="collapse" data-target="#password">
                                    <i class="icon-circle-down2"></i>
                                </a>
                            </legend>
                            <div class="collapse show" id="password">
                                <x-text-field
                                    name="password"
                                    placeholder="********"
                                    :label="__('Nhập mật khẩu')"
                                    type="password"
                                >
                                </x-text-field>

                                <x-text-field
                                    name="password_confirmation"
                                    placeholder="********"
                                    :label="__('Nhập lại mật khẩu')"
                                    type="password"
                                >
                                </x-text-field>
                            </div>
                        </fieldset>

                    </x-card>
                    <div class="d-flex justify-content-center align-items-center action" id="action-form">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Trở lại') }}</a>
                        <div class="btn-group ml-3">
                            <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Tạo') }}</button>
                            <button class="btn bg-success dropdown-toggle" data-toggle="dropdown"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.admins.index') }}">{{ __('Lưu và thoát') }}</a>
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.admins.create') }}">{{ __('Lưu và thêm mới') }}</a>
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
                                    <a href="#general" class="nav-link active"><i class="icon-info3"></i> {{ __('Chung') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#password" class="nav-link"><i class="icon-lock2"></i> {{ __('Mật khẩu') }}</a>
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

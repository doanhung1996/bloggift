<div class="navbar navbar-expand-md navbar-white bg-white navbar-static">

    <div class="navbar-header navbar-white bg-white d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
                <img src="/admin/global_assets/images/logo.png" alt="">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs pl-1">
            <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
                <img src="/admin/global_assets/images/logo.png" alt="">
            </a>
        </div>
    </div>
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
                <img src="/admin/global_assets/images/logo.png" alt="">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>


    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

        </ul>

        <span class="badge badge-pill ml-md-3 mr-md-auto"> </span>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0)" class="navbar-nav-link">
                    <img src="/admin/global_assets/images/lang/vi.png" class="img-flag mr-2" alt="">
                    Việt Nam
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0 -color-clear" style="color: #9e9e9eba !important;" data-toggle="dropdown">
                    <i class="icon-bell3"></i>
                    <span class="d-md-none ml-2">Thông báo</span>
                    <span class="badge ml-auto ml-md-0">3</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Thông báo</span>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="/admin/global_assets/images/logo.png" width="36" height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">James Alexander</span>
                                            <span class="text-muted float-right font-size-sm">04:58</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="/admin/global_assets/images/logo.png" width="36" height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Margo Baker</span>
                                            <span class="text-muted float-right font-size-sm">12:16</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">That was something he was unable to do because...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="/admin/global_assets/images/logo.png" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Jeremy Victorino</span>
                                            <span class="text-muted float-right font-size-sm">22:48</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="/admin/global_assets/images/logo.png" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Beatrix Diaz</span>
                                            <span class="text-muted float-right font-size-sm">Tue</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="/admin/global_assets/images/logo.png" width="36" height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Richard Vango</span>
                                            <span class="text-muted float-right font-size-sm">Mon</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-white">
                        <a href="#" class="text-grey mr-auto">Tất cả</a>
                        <div>
                            <a href="#" class="text-grey" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>
                            <a href="#" class="text-grey ml-2" data-popup="tooltip" title="Settings"><i class="icon-cog3"></i></a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ $currentUser->getFirstMediaUrl('avatar') }}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{ $currentUser->full_name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Thông báo <span class="badge badge-pill ml-auto">3</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.account-settings.edit') }}" class="dropdown-item"><i class="icon-cog5"></i> {{ __('Thiết lập tài khoản') }}</a>
                    <x-form-button :action="route('admin.logout')" class="dropdown-item">
                        <i class="icon-switch2"></i>
                        {{ __('Đăng xuất') }}
                    </x-form-button>
                </div>
            </li>
        </ul>
    </div>
    <!-- /navbar content -->

</div>

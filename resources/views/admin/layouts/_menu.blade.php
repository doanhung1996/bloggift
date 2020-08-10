<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Menu Chính
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="{{ $currentUser->getFirstMediaUrl('avatar') }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{ $currentUser->full_name }}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">Việt Nam</span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Tài khoản</span></a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-comment-discussion"></i>
                            <span>Thông báo</span>
                            <span class="badge bg-success-400 badge-pill align-self-center ml-auto">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.account-settings.edit') }}" class="nav-link">
                            <i class="icon-cog5"></i>
                            <span>{{ __('Thiết lập tài khoản') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" onclick="$('#logout-form').submit()">
                            <i class="icon-switch2"></i>
                            <span>{{ __('Đăng xuất') }}</span>
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{ __('Menu') }}</div> <i class="icon-menu" title="{{ __('Main') }}"></i></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>
                            {{ __('Trang chủ') }}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.taxonomies.index') }}" class="nav-link {{ request()->routeIs('admin.taxonomies*') ? 'active' : null }}"><i class="icon-cube"></i> <span>{{ __('Danh mục') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts*') ? 'active' : null }}">
                        <i class="icon-book"></i>
                        <span>
                            {{ __('Danh sách bài viết') }}
                        </span>
                    </a>
                </li>
                <!-- System -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{ __('Hệ thống') }}</div> <i class="icon-menu" title="{{ __('Hệ thống') }}"></i></li>
                <li class="nav-item nav-item-submenu {{ request()->routeIs('admin.admins*') || request()->routeIs('admin.roles*') ? 'nav-item-expanded nav-item-open' : null }}">
                    <a href="#" class="nav-link"><i class="icon-people"></i> <span>{{ __('Tài khoản') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="{{ __('Tài khoản') }}">
                        <li class="nav-item"><a href="{{ route('admin.admins.index') }}" class="nav-link @if(request()->routeIs('admin.admins*'))active @endif">{{ __('Tài khoản') }}</a></li>
                        <li class="nav-item"><a href="{{ route('admin.roles.index') }}" class="nav-link @if(request()->routeIs('admin.roles*'))active @endif">{{ __('Quyền') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>

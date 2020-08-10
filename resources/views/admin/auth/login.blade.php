@extends('admin.layouts.base')

@section('title', __('Đăng nhập'))

@section('content')
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center pt-0">

                <!-- Login card -->
                <form class="login-form" action="{{ route('admin.login') }}" method="POST" id="login-form" data-block>
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">{{ __('Đăng nhập') }}</h5>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input value="{{ old('email') }}" id="email" name="email" type="email" class="form-control @error('email') border-danger @enderror" placeholder="{{ __('Email') }}">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                @error('email')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="password" name="password" type="password" class="form-control @error('password') border-danger @enderror" placeholder="{{ __('Mật khẩu') }}">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                @error('password')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <div class="form-check mb-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-input-styled" data-fouc>
                                        {{ __('Nhớ mật khẩu') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block">
                                    {{ __('Đăng nhập') }}
                                    <i class="icon-circle-right2 ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login card -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
@stop

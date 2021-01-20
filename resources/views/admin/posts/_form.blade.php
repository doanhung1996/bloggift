<form action="{{ $url }}" method="POST" data-block enctype="multipart/form-data" id="post-form">
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
                                    name="title"
                                    :placeholder="__('Tiêu đề bài viết')"
                                    :label="__('Tiêu đề bài viết')"
                                    :value="$post->title"
                                    required
                                >
                                </x-text-field>

{{--                                <x-text-field--}}
{{--                                    name="description"--}}
{{--                                    :placeholder="__('Mô tả')"--}}
{{--                                    :label="__('Mô tả')"--}}
{{--                                    :value="$post->description"--}}
{{--                                    required--}}
{{--                                >--}}
{{--                                    {!! $post->description ?? null !!}--}}
{{--                                </x-text-field>--}}
                                <div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-right" for="image">
                                            <span class="text-danger">*</span>
                                            {{ __("Ảnh") }} :
                                        </label>
                                        <div class="col-lg-9">
                                            <div class="card-img-actions d-inline-block mb-3">
                                                <img class="img-fluid rounded-circle" src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg'}}" width="170" height="170" alt="" id="image-preview">
                                                <div class="card-img-actions-overlay rounded-circle">
                                                    <a href="javascript:void(0)" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 legitRipple select-file" data-input="#image">
                                                        <i class="icon-link"></i>
                                                    </a>
                                                    <input type="file" class="d-none" name="image" id="image" data-preview="#image-preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-right">
                                        <span class="text-danger">*</span>
                                        Trạng thái :
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="status" id="status" class="form-control form-control-select2" data-placeholder="Trạng thái">
                                            <option value="{{ \App\Enums\StatusPost::Pending }}" @if(old('status') == \App\Enums\StatusPost::Pending) {{ 'selected' }} @elseif($post->status == \App\Enums\StatusPost::Pending) {{ 'selected' }} @endif>Đang chờ</option>
                                            <option value="{{ \App\Enums\StatusPost::Active }}" @if(old('status') == \App\Enums\StatusPost::Active) {{ 'selected' }} @elseif($post->status == \App\Enums\StatusPost::Active) {{ 'selected' }} @endif>Hoạt động</option>
                                            <option value="{{ \App\Enums\StatusPost::Disabled }}" @if(old('status') == \App\Enums\StatusPost::Disabled) {{ 'selected' }} @elseif($post->status == \App\Enums\StatusPost::Disabled) {{ 'selected' }} @endif>Hủy</option>
                                        </select>
                                        @error('status')
                                        <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-right" for="Loại thành viên">
                                        <span class="text-danger">*</span>
                                        Dạng bài đăng :
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="type" id="type" class="form-control form-control-select2" data-placeholder="Loại thành viên">
                                            <option value="{{ \App\Enums\TypePost::TEXT }}" @if(old('type') == \App\Enums\TypePost::TEXT) {{ 'selected' }} @elseif($post->type == \App\Enums\TypePost::TEXT) {{ 'selected' }} @endif>Text</option>
                                            <option value="{{ \App\Enums\TypePost::VIDEO }}" @if(old('type') == \App\Enums\TypePost::VIDEO) {{ 'selected' }} @elseif($post->type == \App\Enums\TypePost::VIDEO) {{ 'selected' }} @endif>Video</option>
                                            <option value="{{ \App\Enums\TypePost::FILE }}" @if(old('type') == \App\Enums\TypePost::FILE) {{ 'selected' }} @elseif($post->type == \App\Enums\TypePost::FILE) {{ 'selected' }} @endif>File</option>
                                            <option value="{{ \App\Enums\TypePost::IMAGE }}" @if(old('type') == \App\Enums\TypePost::IMAGE) {{ 'selected' }} @elseif($post->type == \App\Enums\TypePost::IMAGE) {{ 'selected' }} @endif>Image</option>
                                            <option value="{{ \App\Enums\TypePost::LESSON }}" @if(old('type') == \App\Enums\TypePost::LESSON) {{ 'selected' }} @elseif($post->type == \App\Enums\TypePost::LESSON) {{ 'selected' }} @endif>Bài Học</option>
                                        </select>
                                        @error('type')
                                        <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="image-input" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label text-lg-right" for="Loại thành viên">
                                            <span class="text-danger">*</span>
                                            Ảnh :
                                        </label>
                                        <div class="col-lg-9">
                                            <div id="classify-data"></div>
                                            <div class="m-portlet__body">

                                                <h3 class="m-portlet__head-text">
                                                    Chỉnh sửa hình ảnh sản phẩm
                                                </h3>
                                                <span class="m-form__help">
                                                    Kéo để sắp xếp lại hình ảnh của bạn
                                                </span>
                                                <div class="form-group m-form__group">
                                                    <div class="wraper-row-store row form-group">
                                                        <div class="col-lg-12">
                                                            <div class="m-dropzone dropzone m-dropzone--success" id="post-images">
                                                                <div class="m-dropzone__msg dz-message needsclick">
                                                                    <h3 class="m-dropzone__msg-title"> Thêm ảnh</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="text-input" style="display: none;">
                                    <x-textarea-field
                                        name="text"
                                        :placeholder="__('Nội dung')"
                                        :label="__('Nội dung')"
                                        :value="$post->text"
                                        class="wysiwyg"
                                    >
                                    </x-textarea-field>
                                </div>

                                <div id="video-input" style="display: none;">
                                    <x-text-field
                                        name="video"
                                        :placeholder="__('Đường dẫn')"
                                        :label="__('Đường dẫn')"
                                        :value="$post->video"
                                    >
                                    </x-text-field>
                                </div>
{{--                                <div id="image-input" style="display: none;">--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-lg-3 col-form-label text-right" for="image">--}}
{{--                                            <span class="text-danger">*</span>--}}
{{--                                            {{ __("Ảnh") }} :--}}
{{--                                        </label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <div class="card-img-actions d-inline-block mb-3">--}}
{{--                                                <img class="img-fluid rounded-circle" src="{{ $post->getFirstMediaUrl('image') ?? '/admin/global_assets/images/placeholders/placeholder.jpg'}}" width="170" height="170" alt="" id="image-preview">--}}
{{--                                                <div class="card-img-actions-overlay rounded-circle">--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 legitRipple select-file" data-input="#image">--}}
{{--                                                        <i class="icon-link"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <input type="file" class="d-none" name="image" id="image" data-preview="#image-preview">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div id="file-input" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-lg-3 text-lg-right col-form-label"><span class="text-danger">*</span> Vui lòng tải file</label>
                                        <div class="col-lg-9">
                                            <input type="file" name="file" class="form-control-uniform" data-fouc>
                                            @error('file')
                                            <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="select-taxon" class="col-lg-3 text-lg-right col-form-label">
                                        <span class="text-danger">*</span> Danh mục
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="category" name="category" data-width="100%">
                                            <option value="">
                                                Chọn danh mục
                                            </option>
                                            @foreach($post->taxons as $taxon)
                                                <option value="{{ $taxon->id }}" selected>
                                                    {{ $taxon->selectText() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="form-text text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <x-textarea-field
                                    name="body"
                                    :placeholder="__('Chi tiết bài viết')"
                                    :label="__('Chi tiết bài viết')"
                                    :value="$post->body"
                                    class="wysiwyg"
                                    required
                                >
                                </x-textarea-field>

                                <x-text-field
                                    name="meta_title"
                                    :placeholder="__('Meta Title')"
                                    :label="__('Meta Title')"
                                    type="text"
                                    :value="$post->meta_title"
                                >
                                </x-text-field>

                                <x-text-field
                                    name="meta_keywords"
                                    :placeholder="__('Meta Keyword')"
                                    :label="__('Meta Keyword')"
                                    type="text"
                                    :value="$post->meta_keywords"
                                >
                                </x-text-field>

                                <x-text-field
                                    name="meta_description"
                                    :placeholder="__('Meta Description')"
                                    :label="__('Meta Description')"
                                    type="text"
                                    :value="$post->meta_description"
                                >
                                </x-text-field>
                            </div>
                        </fieldset>

                    </x-card>
                    <div class="d-flex justify-content-center align-items-center action" id="action-form">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-light"><i class="icon-close2 mr-2"></i>{{ __('Trở lại') }}</a>
                        <div class="btn-group ml-3">
                            <button class="btn bg-success btn-block" data-loading><i class="icon-paperplane mr-2"></i>{{ __('Lưu') }}</button>
                            <button class="btn bg-success dropdown-toggle" data-toggle="dropdown"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.posts.index') }}">{{ __('Lưu và thoát') }}</a>
                                <a href="javascript:void(0)" class="dropdown-item submit-type" data-redirect="{{ route('admin.posts.create') }}">{{ __('Lưu và thêm mới') }}</a>
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

@push('js')
    <script>
        $(document).ready(function () {
            checkTypePost($('#type').val());
        });

        $('#type').on('change', function () {
            checkTypePost($('#type').val());
        });

        function checkTypePost(type){
            if(type == '{{\App\Enums\TypePost::TEXT}}'){
                $('#video-input').css('display', 'none');
                $('#text-input').css('display', 'block');
                $('#image-input').css('display', 'none');
                $('#file-input').css('display', 'none');
            }else if(type == '{{\App\Enums\TypePost::VIDEO}}'){
                $('#video-input').css('display', 'block');
                $('#text-input').css('display', 'none');
                $('#image-input').css('display', 'none');
                $('#file-input').css('display', 'none');
            }else if(type == '{{\App\Enums\TypePost::IMAGE}}'){
                $('#video-input').css('display', 'none');
                $('#text-input').css('display', 'none');
                $('#image-input').css('display', 'block');
                $('#file-input').css('display', 'none');
            }else if(type == '{{\App\Enums\TypePost::FILE}}'){
                $('#video-input').css('display', 'none');
                $('#text-input').css('display', 'none');
                $('#image-input').css('display', 'none');
                $('#file-input').css('display', 'block');
            }else if(type == '{{\App\Enums\TypePost::LESSON}}'){
                $('#video-input').css('display', 'block');
                $('#text-input').css('display', 'none');
                $('#image-input').css('display', 'none');
                $('#file-input').css('display', 'none');
            }
        }

        $(document).ready(function () {
            setTaxonSelect('#category');
        });
        function setTaxonSelect(selector) {
            function formatTaxon (taxon) {
                return taxon.pretty_name;
            }
            if ($(selector).length > 0) {
                $(selector).select2({
                    placeholder: "{{ __('Chọn danh mục') }}",
                    width: '100%',
                    ajax: {
                        url: "{{ route('admin.taxons.search') }}",
                        datatype: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.data,
                                pagination: {
                                    more: (params.page * 15) < data.total
                                }
                            };
                        },
                    },
                    templateResult: formatTaxon,
                    templateSelection: function(item) { return item.pretty_name || item.text; }
                });
            }
        }
        $(document).ready(function () {
            $('.form-control-uniform').uniform();
        });
    </script>
@endpush

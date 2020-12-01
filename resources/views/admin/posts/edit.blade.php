@extends('admin.layouts.master')

@section('title', __('Chỉnh sửa :model', ['model' => $post->title]))
@section('page-header')
    <x-page-header>
        <x-slot name='title'>
            <h4><i class="icon-people mr-2"></i> <span class="font-weight-semibold">{{ __('Chỉnh sửa :model', ['model' => $post->title]) }}</span></h4>
        </x-slot>
        {{ Breadcrumbs::render() }}
    </x-page-header>
@stop

@section('page-content')
    @include('admin.posts._form', [
        'url' =>  route('admin.posts.update', $post),
        'post' => $post ?? new \App\Domain\Post\Models\Post,
        'method' => 'PUT'
    ])
@stop
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css" integrity="sha512-CmjeEOiBCtxpzzfuT2remy8NP++fmHRxR3LnsdQhVXzA3QqRMaJ3heF9zOB+c1lCWSwZkzSOWfTn1CdqgkW3EQ==" crossorigin="anonymous" />
    <style>
        .dropzone .dz-preview .dz-image{
            width: 140px;
            height: 86px;
        }

        .dropzone .dz-preview .dz-error-mark, .dropzone .dz-preview .dz-success-mark, .dropzone-previews .dz-preview .dz-error-mark, .dropzone-previews .dz-preview .dz-success-mark{
            right: 50px;
            border: none;
        }

        .dropzone .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-error-mark{
            top: 10%;
            left: 50%;
            margin-left: -35px;
            margin-top: -3px;
        }
    </style>
@endpush
@push('js')
    <script>
        $('.form-check-input-styled').uniform();
    </script>
    <script src="{{ asset('js/editor-admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
    <script>
        let maxFileUpload = 9;
        Dropzone.autoDiscover = true;
        Dropzone.options.postImages = {
            url: '{{ route('admin.posts.upload.image') }}',
            maxFilesize: 2,
            maxFiles: maxFileUpload,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (file, response) {
                $('#post-form').append('<input type="hidden" name="new_images[]" value="' + response.file + '">')
                file.previewElement.classList.add("dz-success")
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.hasOwnProperty('id')) {
                    $('#post-form').find('input[name="images[]"][value="' + file.id + '"]').remove()
                } else {
                    $('#post-form').find('input[name="new_images[]"][value="' + file.name + '"]').remove()
                }
            },
            init: function () {
                var myDropzone = this;
                this.on("addedfile", function(file) {
                    file.previewElement.addEventListener("click", function() {
                        myDropzone.removeFile(file);
                    });
                });
                    @if($post->getMedia()->isNotEmpty())
                    @foreach($post->getMedia() as $key => $image)
                        let mockFile_{{$key}} = { name: '{{ $image->file_name }}', size: '{{ $image->size }}', id: '{{ $image->id }}'};
                        myDropzone.emit("addedfile", mockFile_{{$key}});
                        myDropzone.emit("thumbnail", mockFile_{{$key}}, '{{ $image->getFullUrl() }}');
                        myDropzone.emit("complete", mockFile_{{$key}});
                        $('#post-form').append('<input type="hidden" name="images[]" value="{{ $image->id }}">');
                    @endforeach
                    @endif
                let fileCountOnServer = '{{ $post->getMedia()->count() }}';
                myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;

                myDropzone.on("maxfilesexceeded", function(file) {
                    this.removeFile(file);
                    console.log('{{ __("Max file reached") }}');
                });
            }
        }
    </script>
@endpush


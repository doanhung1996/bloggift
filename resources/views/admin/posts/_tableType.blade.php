<div class="d-flex align-items-center">
    @if($post->type == \App\Enums\TypePost::FILE)
        <span>Tệp tài liệu</span>
    @elseif($post->type == \App\Enums\TypePost::VIDEO)
        <span>Video</span>
    @elseif($post->type == \App\Enums\TypePost::TEXT)
        <span>Nội dung</span>
    @elseif($post->type == \App\Enums\TypePost::IMAGE)
        <span>Ảnh</span>
    @endif
</div>

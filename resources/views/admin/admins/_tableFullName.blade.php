<div class="d-flex align-items-center">
    <div class="mr-3">
        <a href="#">
            <img src="{{ $admin->getFirstMediaUrl('avatar') }}" class="rounded-circle" width="32" height="32" alt="">
        </a>
    </div>
    <div>
        <a href="#" class="text-default font-weight-semibold">{{ $admin->full_name }}</a>
        <div class="text-muted font-size-sm">{{ $admin->roles->implode('display_name', ', ') }}</div>
    </div>
</div>

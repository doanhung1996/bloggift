<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('admin.users.edit', $id) }}" class="dropdown-item"><i class="icon-pencil7 text-primary"></i> {{ __('Chỉnh sửa') }}</a>
            <a href="javascript:void(0)" data-url="{{ route('admin.users.destroy', $id) }}" class="dropdown-item js-delete"><i class="icon-cross2 text-danger"></i> {{ __('Xóa') }}</a>
        </div>
    </div>
</div>

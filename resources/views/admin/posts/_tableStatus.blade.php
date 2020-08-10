<select class="form-control" name="status" id="select_status" data-url="{{ route('admin.posts.change.status', $id) }}">
    <option value="{{ \App\Enums\StatusPost::Pending }}" {{ $status == \App\Enums\StatusPost::Pending  ? 'selected' : '' }}>Chờ phê duyệt</option>
    <option value="{{ \App\Enums\StatusPost::Active }}" {{ $status == \App\Enums\StatusPost::Active ? 'selected' : '' }}>Hoạt động</option>
    <option value="{{ \App\Enums\StatusPost::Disabled }}" {{ $status == \App\Enums\StatusPost::Disabled ? 'selected' : '' }} >Hủy</option>
</select>

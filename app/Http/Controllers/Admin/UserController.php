<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\User\Models\User;
use App\Http\Requests\User\UserBulkDeleteRequest;
use App\Http\Requests\User\UserRequest;
use App\DataTables\UserDataTable;
use App\Domain\Acl\Models\Role;
use App\Domain\User\Actions\UserCreateAction;
use App\Domain\User\Actions\UserUpdateAction;
use App\Domain\User\Actions\BulkDeleteAction;
use App\Domain\User\DTO\UserData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController
{
    use AuthorizesRequests;

    public function index(UserDataTable $dataTable)
    {
        $this->authorize('view', User::class);

        return $dataTable->render('admin.users.index');
    }

    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(UserRequest $request, UserCreateAction $action): RedirectResponse
    {
        $this->authorize('create', User::class);

        $userData = UserData::fromRequest($request);

        $user = $action->execute($userData);

        flash()->success(__('Người dùng ":model" đã được tạo thành công !', ['model' => $user->email]));

        return intended($request, route('admin.users.edit', $user));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request, UserUpdateAction $action): RedirectResponse
    {
        $this->authorize('update', $user);

        $userData = UserData::fromRequest($request);

        $action->execute($user, $userData);

        flash()->success(__('Người dùng ":model" đã được cập nhật !', ['model' => $user->email]));

        return intended($request, route('admin.users.edit', $user));
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => __('Người dùng ":model" đã được xóa !', ['model' => $user->email]),
        ]);
    }

    public function bulkDelete(UserBulkDeleteRequest $request, BulkDeleteAction $action): JsonResponse
    {
        $this->authorize('delete', User::class);

        $deletedRecord = $action->execute($request->input('id'));

        return response()->json([
            'status' => true,
            'message' => __('Đã xóa ":count" người dùng', ['count' => $deletedRecord]),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoleBulkDeleteRequest;
use App\Http\Requests\Admin\RoleRequest;
use App\DataTables\RoleDataTable;
use App\Domain\Acl\Actions\RoleBulkDeleteAction;
use App\Domain\Acl\Actions\RoleCreateAction;
use App\Domain\Acl\Actions\RoleUpdateAction;
use App\Domain\Acl\Models\Permission;
use App\Domain\Acl\Models\Role;
use App\Domain\Admin\DTO\RoleData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController
{
    use AuthorizesRequests;

    public function index(RoleDataTable $dataTable)
    {
        $this->authorize('view', Role::class);

        return $dataTable->render('admin.roles.index');
    }

    public function create(): View
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::with('translation')->get();
        $groupPermissions = $permissions->groupBy(function ($permission) {
            [$group] = explode('.', $permission->name);

            return $group;
        });

        return view('admin.roles.create', compact('groupPermissions'));
    }

    public function store(RoleRequest $request, RoleCreateAction $action): RedirectResponse
    {
        $this->authorize('create', Role::class);

        $roleData = RoleData::fromRequest($request);

        $role = $action->execute($roleData);

        flash()->success(__('Role ":model" has been successfully created!', ['model' => $role->display_name]));

        return intended($request, route('admin.roles.edit', $role));
    }

    public function edit(Role $role): View
    {
        $this->authorize('update', $role);

        $allowPermissions = $role->getPermissionNames()->toArray();
        $permissions = Permission::with('translation')->get();
        $groupPermissions = $permissions->groupBy(function ($permission) {
            [$group] = explode('.', $permission->name);

            return $group;
        });

        return view('admin.roles.edit', compact('allowPermissions', 'role', 'groupPermissions'));
    }

    public function update(Role $role, RoleRequest $request, RoleUpdateAction $action): RedirectResponse
    {
        $this->authorize('update', $role);

        $roleData = RoleData::fromRequest($request);

        $action->execute($role, $roleData);

        flash()->success(__('Role ":model" has been successfully updated!', ['model' => $role->display_name]));

        return intended($request, route('admin.roles.edit', $role));
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->authorize('delete', $role);

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => __('Role ":model" has been successfully deleted!', ['model' => $role->display_name]),
        ]);
    }

    public function bulkDelete(RoleBulkDeleteRequest $request, RoleBulkDeleteAction $action): JsonResponse
    {
        $deletedRecord = $action->execute($request->input('id'));

        return response()->json([
            'status' => true,
            'message' => __('Deleted ":count" records', ['count' => $deletedRecord]),
        ]);
    }
}

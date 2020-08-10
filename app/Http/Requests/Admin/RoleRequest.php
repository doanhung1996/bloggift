<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'display_name' => ['required', 'string', 'max:255'],
            'permissions' => ['required', 'array'],
        ];
    }

    public function allowPermissions(): array
    {
        return array_keys(array_filter($this->input('permissions'), function ($value) {
            return $value == 1;
        }));
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class AdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $this->emailUniqueRule()],
            'password' => $this->passwordRule(),
            'roles' => ['required', 'exists:roles,id'],
        ];
    }

    protected function emailUniqueRule(): Unique
    {
        $rule = Rule::unique('admins');
        if ($this->route()->getName() === 'admin.admins.update') {
            $adminId = $this->route('admin')->id;

            return $rule->ignore($adminId);
        }

        return $rule;
    }

    protected function passwordRule()
    {
        $rule = ['min:8', 'confirmed'];

        if ($this->route()->getName() === 'admin.admins.update') {
            array_unshift($rule, 'nullable');
        } else {
            array_unshift($rule, 'required');
        }

        return $rule;
    }
}

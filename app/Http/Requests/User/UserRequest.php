<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $this->emailUniqueRule()],
            'password' => $this->passwordRule(),
        ];
    }

    protected function emailUniqueRule(): Unique
    {
        $rule = Rule::unique('users');
        if ($this->route()->getName() === 'admin.users.update') {
            $userId = $this->route('user')->id;

            return $rule->ignore($userId);
        }

        return $rule;
    }

    protected function passwordRule()
    {
        $rule = ['min:8', 'confirmed'];

        if ($this->route()->getName() === 'admin.users.update') {
            array_unshift($rule, 'nullable');
        } else {
            array_unshift($rule, 'required');
        }

        return $rule;
    }
}

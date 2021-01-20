<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserBulkDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'array'],
        ];
    }
}

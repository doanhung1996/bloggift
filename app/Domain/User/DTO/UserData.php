<?php

declare(strict_types=1);

namespace App\Domain\User\DTO;

use App\Http\Requests\User\UserRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?string $password;

    public static function fromRequest(UserRequest $request): UserData
    {
        return new self([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('new_password')
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\User\DTO;

use App\Http\Requests\User\AccountUpdateRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserProfileData extends DataTransferObject
{
    public string $first_name;

    public string $last_name;

    public string $email;

    public ?string $password;

    public ?UploadedFile $avatar;

    public static function fromRequest(AccountUpdateRequest $request): UserProfileData
    {
        return new self([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('new_password'),
            'avatar' => $request->file('avatar'),
        ]);
    }
}

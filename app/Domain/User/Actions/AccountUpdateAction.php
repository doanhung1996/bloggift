<?php

declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\DTO\UserProfileData;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountUpdateAction
{
    public function execute(User $user, UserProfileData $userData): void
    {
        $user->first_name = $userData->first_name;
        $user->last_name = $userData->last_name;
        $user->email = $userData->email;
        if (! empty($userData->password)) {
            $user->password = Hash::make($userData->password);
        }
        $user->save();

        if (! empty($userData->avatar)) {
            $user->addMedia($userData->avatar)->toMediaCollection('avatar');
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\DTO\UserData;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserUpdateAction
{
    public function execute(User $user, UserData $userData): void
    {
        DB::transaction(function () use ($user, $userData) {
            $user->name = $userData->name;
            $user->email = $userData->email;
            if (! empty($userData->password)) {
                $user->password = Hash::make($userData->password);
            }
            $user->save();
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\DTO\UserData;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserCreateAction
{
    public function execute(UserData $userData): User
    {
        $user = new User;

        DB::transaction(function () use ($userData, $user) {
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make($userData->password);
            $user->save();
        });

        return $user;
    }
}

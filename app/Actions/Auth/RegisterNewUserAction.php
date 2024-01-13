<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;

class RegisterNewUserAction
{
    public function execute(string $name, string $email): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction
{
    public function execute(string $userId, int $sessionTime): void
    {
        /** @var User $user**/
        $user = User::query()->findOrFail($userId);

        $originalSessionTime = config('session.lifetime');

        config(['session.lifetime' => $sessionTime]);
        Auth::login($user);
        config(['session.lifetime' => $originalSessionTime]);
    }
}

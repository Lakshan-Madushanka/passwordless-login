<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Support\Facades\URL;

class CreateLoginLinkAction
{
    public function execute(string $userId, int $sessionTime = 43200): string
    {
        return URL::temporarySignedRoute(
            name: 'authenticate',
            expiration: now()->addMinutes(10),
            parameters: [
                'id' => $userId,
                'session_time' => $sessionTime,
            ]
        );
    }
}

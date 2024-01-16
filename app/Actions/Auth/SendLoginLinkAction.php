<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use App\Notifications\Auth\LoginLinkCreated;

class SendLoginLinkAction
{
    public function execute(string $email, int $sessionTime = 43200): void
    {
        /** @var CreateLoginLinkAction $createLoginLinkAction * */
        $createLoginLinkAction = app(CreateLoginLinkAction::class);

        /** @var User $user */
        $user = User::query()->where('email', $email)->firstOrFail();

        $user->notify(new LoginLinkCreated($createLoginLinkAction->execute($user->id, $sessionTime)));
    }
}

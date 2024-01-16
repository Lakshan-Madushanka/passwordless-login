<?php

declare(strict_types=1);

use App\Actions\Auth\SendLoginLinkAction;
use App\Models\User;
use App\Notifications\Auth\LoginLinkCreated;
use Illuminate\Support\Facades\Notification;

it('can create a valid login link', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    /** @var SendLoginLinkAction $sendLoginLinkAction */
    $sendLoginLinkAction = app(SendLoginLinkAction::class);

    $sendLoginLinkAction->execute($user->email, 60);

    Notification::assertSentTo($user, LoginLinkCreated::class);
});

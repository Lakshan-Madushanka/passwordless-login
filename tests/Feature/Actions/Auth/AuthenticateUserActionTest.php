<?php

declare(strict_types=1);

use App\Actions\Auth\AuthenticateUserAction;
use App\Models\User;

use function Pest\Laravel\assertAuthenticated;

it('can authenticate a user', function (): void {
    $user = User::factory()->create();

    /** @var AuthenticateUserAction $authAction * */
    $authAction = app(AuthenticateUserAction::class);

    $authAction->execute($user->getKey(), 10);

    assertAuthenticated();
});

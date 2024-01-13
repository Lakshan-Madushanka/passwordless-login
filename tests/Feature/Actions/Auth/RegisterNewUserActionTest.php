<?php

declare(strict_types=1);

use App\Actions\Auth\RegisterNewUserAction;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;

it('can create a new user', function (): void {
    $user = User::factory()->make();

    /** @var RegisterNewUserAction $registerUserAction */
    $registerUserAction = app(RegisterNewUserAction::class);

    $registerUserAction->execute(...$user->toArray());

    assertDatabaseHas('users', [
        ...$user->toArray()
    ]);
});

<?php

declare(strict_types=1);

use App\Actions\Auth\CreateLoginLinkAction;
use App\Models\User;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\get;
use function Pest\Laravel\withoutExceptionHandling;

it('return 401 for malformed url', function (): void {
    $user = User::factory()->create();

    get(route('authenticate', ['id' => $user->id]))
        ->assertForbidden();

});

it('can authenticate a user', function (): void {

    withoutExceptionHandling();
    $user = User::factory()->create();

    $url = app(CreateLoginLinkAction::class)->execute($user->getKey());

    $response = get($url);

    assertAuthenticated();

});

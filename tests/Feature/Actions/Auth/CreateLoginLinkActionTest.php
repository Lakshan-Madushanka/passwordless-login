<?php

declare(strict_types=1);

use App\Actions\Auth\CreateLoginLinkAction;
use App\Models\User;

it('can create a valid login link', function (): void {
    $user = User::factory()->create();

    /** @var CreateLoginLinkAction $createLoginLinkAction */
    $createLoginLinkAction = app(CreateLoginLinkAction::class);

    $link = $createLoginLinkAction->execute($user->getKey(), 60);

    ['path' => $path, 'query' => $queryString] = parse_url($link);

    parse_str($queryString, $query);


    expect(str($path)->contains('authenticate'))
        ->toBeTrue()
        ->and(str($path)->afterLast('/')->toString())
        ->toBe($user->getKey())
        ->and($query['session_time'])
        ->toBe('60');
});

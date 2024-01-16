<?php

declare(strict_types=1);

use App\Actions\Auth\LogOutUserAction;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

it('can authenticate a user', function (): void {
    get('/'); // we should set session store on request

    $user = User::factory()->create();
    /** @var LogOutUserAction $logOutUserAction * */
    $logOutUserAction = app(LogOutUserAction::class);

    actingAs($user);
    assertAuthenticated();

    $logOutUserAction->execute();

    assertGuest();

});

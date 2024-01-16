<?php

declare(strict_types=1);

use App\Models\User;
use App\Notifications\Auth\LoginLinkCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;

it('can render', function (): void {
    $component = Volt::test('register');

    $component->assertSee('Sign In');
});

// Validation tests
it('requires email', function (): void {
    $component = Volt::test('register')
        ->set('email', '')
        ->call('submit')
        ->assertHasErrors(['email' => ['required']]);
});

it('requires valid email', function (): void {
    $component = Volt::test('register')
        ->set('email', 'email')
        ->call('submit')
        ->assertHasErrors(['email' => ['email']]);
});

it('requires name', function (): void {
    $component = Volt::test('register')
        ->set('name', '')
        ->call('submit')
        ->assertHasErrors(['name' => ['required']]);
});

test('name should not exceed 25 characters', function (): void {
    $component = Volt::test('register')
        ->set('name', Str::repeat('a', 26))
        ->call('submit')
        ->assertHasErrors(['name' => ['max']]);
});

// Finish validation tests

it('send login link after successfully registration', function (): void {
    Notification::fake();

    $user = User::factory()->make();

    $component = Volt::test('register')
        ->set('name', $user->name)
        ->set('email', $user->email)
        ->call('submit')
        ->assertHasNoErrors();

    Notification::assertSentTo(User::query()->first(), LoginLinkCreated::class);
});

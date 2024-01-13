<?php

declare(strict_types=1);

use Livewire\Volt\Volt;

it('can render', function (): void {
    $component = Volt::test('login');

    $component->assertSee('Sign In');
});

// Validation tests

it('requires email', function (): void {
    $component = Volt::test('login')
        ->set('email', '')
        ->call('submit')
        ->assertHasErrors(['email' => ['required']]);
});

it('requires valid email', function (): void {
    $component = Volt::test('login')
        ->set('email', 'email')
        ->call('submit')
        ->assertHasErrors(['email' => ['email']]);
});

test('session time must be a string', function (): void {
    $component = Volt::test('login')
        ->set('session_time', 'one')
        ->call('submit')
        ->assertHasErrors(['session_time' => ['integer']]);
});

test('session_time must be between 1 and 43200', function (int $time): void {
    $component = Volt::test('login')
        ->set('session_time', $time)
        ->call('submit')
        ->assertHasErrors(['session_time' => ['between']]);
})->with([0, 43201]);

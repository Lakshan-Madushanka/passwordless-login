<?php

use App\Actions\Auth\RegisterNewUserAction;
use App\Actions\Auth\SendLoginLinkAction;
use Illuminate\Validation\Rule;
use function Laravel\Folio\middleware;
use function Livewire\Volt\{layout, state, rules};
use function Laravel\Folio\name;

name('login');
middleware('guest');

state(['email', 'session_time' => 43200, 'success' => false]);

rules([
    'email' => ['required', 'email', Rule::exists('users')],
    'session_time' => ['integer', 'between:1,43200'],
]);

$submit = function (SendLoginLinkAction $sendLoginLinkAction) {
    $this->success = false;

    $this->validate();

    $sendLoginLinkAction->execute(email: $this->email, sessionTime: $this->session_time);

    $this->success = true;
};


?>

<x-layouts.app>
    <div class="min-h-screen flex flex-col justify-center items-center">
        <x-slot:title>
            Log In
        </x-slot:title>
        <h1 class="text-4xl text-blue-600 font-bold text-center my-4">Sign In</h1>
        @volt
        <main class="w-full max-w-screen-sm">
            <form wire:submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-6">
                    <x-inputs.label for="email">Email</x-inputs.label>
                    <x-inputs
                        wire:model="email"
                        id="email"
                        @class(['!border-red-500' => $errors->has('email')])
                        type="email"
                        placeholder="email"
                    />
                    @error('email') <span class="text-red-500">{{$message}}</span> @enderror
                </div>
                <div class="mb-6">
                    <x-inputs.label for="session_time">Session time in minutes</x-inputs.label>
                    <x-inputs
                        wire:model="session_time"
                        id="session_time"
                        @class(['!border-red-500' => $errors->has('session_time')])
                        type="number"
                        value="43200"
                        min="1"
                        max="43200"
                        placeholder="session time"
                    />
                    @error('session_time') <span class="text-red-500">{{$message}}</span> @enderror
                </div>
                @if($success)
                    <div class="mb-6">
                        <p class="text-center text-green-600 font-bold">Login link sent to your email address.</p>
                    </div>
                @endif
                <div class="flex items-center justify-between">
                    <x-button>
                        @if(! $success)
                            Sign In
                        @else
                            Resend
                        @endif                        </x-button>
                    <x-a wire:navigate class="text-lg" href="{{route('register')}}">
                        Sign Up
                    </x-a>
                </div>
            </form>
        </main>
    </div>
    @endvolt
</x-layouts.app>

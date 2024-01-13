<?php

use App\Actions\Auth\RegisterNewUserAction;
use function Livewire\Volt\{layout, state, rules};
use function Laravel\Folio\name;

name('login');

state(['email', 'session_time' => 43200]);

rules([
    'email' => ['required', 'email'],
    'session_time' => ['integer', 'between:1,43200'],
]);

$submit = function (RegisterNewUserAction $registerNewUserAction) {
    $this->validate();

    dd($this->session_time);
    //$registerNewUserAction->execute();
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
                <div class="flex items-center justify-between">
                    <x-button>
                        Sign In
                    </x-button>
                    <x-a wire:navigate class="text-lg" href="{{route('register')}}">
                        Sign Up
                    </x-a>
                </div>
            </form>
        </main>
    </div>
    @endvolt
</x-layouts.app>

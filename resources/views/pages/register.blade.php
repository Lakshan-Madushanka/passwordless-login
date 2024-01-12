<?php

use function Livewire\Volt\{layout, state, rules};

state(['name', 'email']);

rules([
    'name' => ['required', 'max:25'],
    'email' => ['required', 'email']
]);

$submit = function () {
    $this->validate();
};


?>

<x-layouts.app>
    <div class="min-h-screen flex flex-col justify-center items-center">
        <x-slot:title>
            Register
        </x-slot:title>
        <h1 class="text-4xl text-blue-600 font-bold text-center my-4">Sign Up</h1>
        @volt
        <main class="w-full max-w-screen-sm">
            <form wire:submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <x-inputs.label for='name'>Name</x-inputs.label>
                    <x-inputs
                        wire:model="name"
                        id="name"
                        @class(['!border-red-500' => $errors->has('name')])
                        type="text"
                        placeholder="name"
                    />
                    @error('name') <span class="text-red-500">{{$message}}</span> @enderror
                </div>
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
                <div class="flex items-center justify-between">
                    <x-button>
                        Sign Up
                    </x-button>
                </div>
            </form>
        </main>
    </div>
    @endvolt
</x-layouts.app>

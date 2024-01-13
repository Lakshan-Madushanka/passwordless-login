<?php

use App\Actions\Auth\RegisterNewUserAction;
use Illuminate\Validation\Rule;
use function Livewire\Volt\{layout, state, rules};
use function Laravel\Folio\name;

name('register');

state(['name', 'email', 'success' => false,]);

rules([
    'name' => ['required', 'max:25'],
    'email' => ['required', 'email', Rule::unique('users')]
]);

$submit = function (RegisterNewUserAction $registerNewUserAction) {
    $this->validate();

    $user = $registerNewUserAction->execute($this->name, $this->email);

    $this->success = true;
};

?>

<x-layouts.app>
    @volt
    <main>
        @if($success)
            <x-slot:title>
                Registration success
            </x-slot:title>
            <div
                class="min-h-screen flex flex-col justify-center items-center">
                <div class="text-center p-4 max-w-screen-sm shadow-lg shadow-amber-600 bg-white rounded">
                    <h1 class="font-bold text-xl mb-4">You have successfully registered to the system</h1>
                    <p>We have emailed you that contains login url to your email address.</p>
                    <small>If you haven't received the email click <x-a href="{{route('login')}}">login</x-a> button to resend.</small>
                </div>
            </div>
        @else
            <div class="min-h-screen flex flex-col justify-center items-center">
                <x-slot:title>
                    Register
                </x-slot:title>
                <h1 class="text-4xl text-blue-600 font-bold text-center my-4">Sign Up</h1>
                <div class="w-full max-w-screen-sm">
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
                            <x-button wire:loading.remove>
                                Sign Up
                            </x-button>
                            <x-spinner wire:loading/>

                            <x-a wire:navigate class="text-lg" href="{{route('login')}}">
                                Sign In
                            </x-a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </main>
    @endvolt
</x-layouts.app>

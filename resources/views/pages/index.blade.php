<?php

use App\Actions\Auth\LogOutUserAction;
use Illuminate\Support\Facades\Auth;
use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('home');
middleware('auth');

$logout = function (LogOutUserAction $logOutUserAction) {
    $logOutUserAction->execute();

    return $this->redirect('/');
}

?>

<x-layouts.app>

    @volt
    <div class="min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-center text-2xl font-bold">Welcome, {{Auth::user()->name}}</h1>
        <x-a class="my-4" wire:click="logout">Log Out</x-a>
    </div>
    @endvolt
</x-layouts.app>


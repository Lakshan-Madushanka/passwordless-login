<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::middleware(['signed'])->get('/authenticate/{id}', AuthenticateController::class)->name('authenticate');

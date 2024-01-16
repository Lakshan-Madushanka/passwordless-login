<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutUserAction
{
    public function __construct(private readonly Request $request) {}

    public function execute(): void
    {
        Auth::logout();


        $this->request->session()->invalidate();

        $this->request->session()->regenerateToken();
    }
}

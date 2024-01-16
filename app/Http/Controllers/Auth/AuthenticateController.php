<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\AuthenticateUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function __construct(private readonly AuthenticateUserAction $authenticateUserAction)
    {
    }

    public function __invoke(Request $request, string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authenticateUserAction->execute($id, (int) $request->query('session_time'));

        return view('pages.index', ['authUser' => Auth::user()]);
    }
}

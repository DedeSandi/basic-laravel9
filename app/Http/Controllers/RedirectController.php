<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return 'Redirect To';
    }
    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    // redirect to named route
    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'dede']);
    }
    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    // redirect to controller action
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'eka']);
    }

    // redirect to external domain
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.udemy.com');
    }
}

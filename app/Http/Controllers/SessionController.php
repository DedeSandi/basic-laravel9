<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        // session()->put();
        $request->session()->put('userId', 'eka');
        $request->session()->put('isMember', true);
        return 'OK';
    }
    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', 'false');
        return "user ID : $userId, Is Member : $isMember";
    }
}

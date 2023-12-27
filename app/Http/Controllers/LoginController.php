<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request, string $locale): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // local variable to ensure we are redirected with the correct locale
            $login = "/$locale/";
            $request->session()->regenerate();
            return redirect()->intended($login);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $locale
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request, string $locale): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // local variable to ensure we are redirected with the correct locale
        $logout = "/$locale/";

        return redirect()->intended($logout)
            ->withSuccess('You have logged out successfully!');
    }
}

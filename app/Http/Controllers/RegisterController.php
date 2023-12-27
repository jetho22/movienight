<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, string $locale): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string'],

        ]);

        //$hashedPassword = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // local variable to ensure we are redirected with the correct locale
            $registerurl = "/$locale/";
            $request->session()->regenerate();
            return redirect()->intended($registerurl);
        }
        return back()->withErrors([
            'email' => 'The provided email already matches an account in our records.',
            'password' => 'The provided email already matches an account in our records.',
        ])->onlyInput('email', 'password');
    }
}

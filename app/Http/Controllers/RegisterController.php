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
    public function register(Request $request): RedirectResponse
    {
        // Validate the user details
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string'],

        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        // Get the credentials
        $credentials = $request->only('email', 'password');

        // If no errors we register the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // If there are errors, we return the error
        return back()->withErrors([
            'email' => 'The provided email already matches an account in our records.',
            'password' => 'The provided email already matches an account in our records.',
        ])->onlyInput('email', 'password');
    }
}

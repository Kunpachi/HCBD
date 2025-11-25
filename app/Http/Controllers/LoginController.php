<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LoginController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', only: ['showForm', 'login']),
            new Middleware('auth', only: ['logout']),
        ];
    }

    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi username & password
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $remember = $request->boolean('remember');

        // Auth::attempt akan mencari kolom 'username' dan 'password'
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
            // intended menangani redirect ke URL yang awalnya diblok oleh middleware auth
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
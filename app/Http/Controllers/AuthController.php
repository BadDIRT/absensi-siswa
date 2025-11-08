<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{

    // LOGIN
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','min:8'],
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'email.regex' => 'Email harus berakhiran @gmail.com'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ REDIRECT BERDASARKAN ROLE
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/admin');
            } elseif ($role === 'teacher') {
                return redirect('/teacher');
            } else {
                return redirect('/student');
            }
        }
 

        return back()
            ->withErrors(['login' => 'Email atau password salah'])
            ->withInput();

    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

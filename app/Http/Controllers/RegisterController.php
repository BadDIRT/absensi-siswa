<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
    public function registerProcess(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
        'password' => 'required|min:8',
    ], [
        'password.min' => 'Password minimal 8 karakter.',
        'email.regex' => 'Email harus berakhiran @gmail.com'
        
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'default',
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil!');
}

}

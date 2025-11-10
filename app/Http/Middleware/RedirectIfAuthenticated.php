<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'teacher':
                        return redirect('teacher.dashboard');
                    case 'student':
                        return redirect('student.dashboard');
                    default:
                        return redirect('/'); // fallback
                }
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserCanAccessFilament
{
    public function handle(Request $request, Closure $next)
    {
        // Not logged in → redirect to Filament login
        if (! Auth::check()) {
            return redirect('/admin/login');
        }

        $user = Auth::user();

        // If role is 'customer' → logout and show message
        if ($user->role === 'customer') {
            Auth::logout(); // clear session

            return redirect('/admin/login')->with('error', 'You cannot login as a customer.');
        }

        // Optional: additional Filament authorization
        if (method_exists($user, 'canAccessFilament') && ! $user->canAccessFilament()) {
            Auth::logout();

            return redirect('/admin/login')->with('error', 'You are not authorized to access the admin panel.');
        }

        // Authorized → proceed
        return $next($request);
    }
}

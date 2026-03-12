<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsNotArtist
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        $user = Auth::user();

        // Check if user has artist role
        $isArtist = $user->roles()->where('slug', 'artist')->exists();

        if ($isArtist) {
            Auth::logout();
            return redirect()->route('login.form')
                ->with('error', 'Artists are not allowed to access admin panel.');
        }

        return $next($request);
    }
}
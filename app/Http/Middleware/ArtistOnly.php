<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ArtistOnly
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        // Check artist role
        $hasArtistRole = $user->roles()
            ->where('slug', 'artist')
            ->exists();

        if (!$hasArtistRole) {
            Auth::logout();
            return redirect('/')->with('error', 'Only artist can login');
        }

        return $next($request);
    }
}
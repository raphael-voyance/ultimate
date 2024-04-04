<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ComingSoon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifiez si le site est en mode "Coming Soon".
        if ($this->isComingSoon()) {
            if (Auth::check() && Auth::user()->hasRole('Admin') ) {
                // L'utilisateur est connecté, permettez-lui d'accéder au site.
                return $next($request);
            }elseif(Auth::check() && Auth::user()->hasRole('Consultant') ) {
                Auth::logout();
                return redirect()->route('coming_soon');
            }
            return redirect()->route('coming_soon');
        }

        return $next($request);
    }

    protected function isComingSoon()
    {
        return env('APP_COMING');
    }
}

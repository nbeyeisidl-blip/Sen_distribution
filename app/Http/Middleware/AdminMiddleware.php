<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   public function handle(Request $request, Closure $next): Response
    {
        // 1. Redirection vers la route d'authentification unifiée "login"
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Vérification du rôle Administrateur
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
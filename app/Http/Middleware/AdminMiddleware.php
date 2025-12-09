<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administrateur;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user() instanceof Administrateur) {
            return redirect()->route('dashboard')
                ->with('error', 'Accès non autorisé. Vous devez être administrateur.');
        }

        return $next($request);
    }
} 
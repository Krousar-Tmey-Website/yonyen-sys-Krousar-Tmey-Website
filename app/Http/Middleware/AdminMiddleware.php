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
        if (!Auth::check() || !Auth::user()->is_admin) {
            // guest() remembers the originally-requested URL (GET requests only) so
            // login() can send the admin straight back to it instead of the dashboard.
            return redirect()->guest(route('admin.login'))->with('error', 'Please log in to access the admin panel.');
        }

        return $next($request);
    }
}

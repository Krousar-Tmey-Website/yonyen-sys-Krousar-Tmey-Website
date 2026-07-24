<?php

namespace App\Http\Middleware;

use App\Services\LocalizationManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function __construct(protected LocalizationManager $localization) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale');

        if ($locale && ! in_array($locale, $this->localization->locales(), true)) {
            // A locale was removed from lang/ since it was stored in the session — fall back cleanly.
            session()->forget('locale');
            $locale = null;
        }

        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}

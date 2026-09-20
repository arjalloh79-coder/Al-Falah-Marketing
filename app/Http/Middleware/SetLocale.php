<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /** Languages the site is actually translated into. French first — it is
     *  the primary market, and is used as the fallback. */
    protected const SUPPORTED = ['fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        // 1. An explicit choice always wins: the language switcher sets a
        //    'lang' cookie, and /language/{locale} puts it in the session.
        $locale = $_COOKIE['lang'] ?? session('locale');

        // 2. Otherwise follow the visitor's browser. getPreferredLanguage()
        //    returns the best match from Accept-Language and falls back to the
        //    first entry of the list — 'fr' — when nothing matches.
        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = $request->getPreferredLanguage(self::SUPPORTED) ?: 'fr';
        }

        App::setLocale($locale);

        return $next($request);
    }
}

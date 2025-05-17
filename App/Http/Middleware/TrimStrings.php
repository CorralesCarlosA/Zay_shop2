<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrimStrings
{
    public function handle(Request $request, Closure $next): Response
    {
        foreach ($request->all() as $key => $value) {
            if (is_string($value)) {
                $request[$key] = trim($value);
            }
        }

        return $next($request);
    }
}

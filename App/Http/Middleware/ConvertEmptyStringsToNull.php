<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertEmptyStringsToNull
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(
            collect($request->all())->mapWithKeys(function ($value, $key) {
                return [$key => is_string($value) && $value === '' ? null : $value];
            })->all()
        );

        return $next($request);
    }
}

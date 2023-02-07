<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /*
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    // exclude some routes just for developers to avoid problems locally

    public function handle($request, Closure $next)
    {
        if (app()->environment(['local'])) {
            $this->except = [
                'login',
                'register',
            ];
        }

        return $next($request);
    }

    protected $except = [];
}

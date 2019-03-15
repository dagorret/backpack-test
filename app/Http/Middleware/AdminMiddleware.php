<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (! backpack_user()->hasRole('admin'))
            return response(trans('backpack::base.unauthorized'),401);
        return $next($request);
    }
}

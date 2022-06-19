<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd($request->route()->middleware());
        if (! $request->expectsJson()) {
            if ($request->segment(1) == 'vendor') {
                return redirect($request->segment(1) . '/vendor/login');
            }
            return route('login');
        }
    }
}

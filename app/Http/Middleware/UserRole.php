<?php

namespace App\Http\Middleware;

use Closure;

class UserRole
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next, $role)
    {
        if ($role == '1') {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

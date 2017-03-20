<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Modules\Users\Entities\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission, ...$roles)
    {

        if (Auth::guest()) {
            return redirect('/');
        }

        if (!$request->user()->hasAnyRole($roles)) {
            return redirect('/');
        }

        if (! $request->user()->can($permission)) {
            return redirect('/');
        }

        return $next($request);
    }
}

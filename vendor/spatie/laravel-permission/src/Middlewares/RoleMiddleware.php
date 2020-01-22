<?php

namespace Spatie\Permission\Middlewares;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
       if (Auth::guard("admin")->guest()) {
         //  dd(Auth::guard("admin")->guest());
           throw UnauthorizedException::notLoggedIn();
       }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::guard("admin")->user()->hasAnyRole($roles)) {
           dd(Auth::guard("admin")->user());
            throw UnauthorizedException::forRoles($roles);
        }
        dump(Carbon::now()->format("Y-m-d"));
        return $next($request);
    }
}

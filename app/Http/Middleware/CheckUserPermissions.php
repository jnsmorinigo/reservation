<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\MiddlewareBase;

class CheckUserPermissions extends MiddlewareBase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$abilities
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        $user = $this->getUserModelInstance($request);
        $userPermissions = $this->getUserPermissions($user);

        foreach ($abilities as $ability) {
            if (in_array($ability, $userPermissions)) {
                return $next($request);
            }
        }

        // Redirect to a 403 Forbidden page or show a specific error view
        abort(403, 'You do not have the required permissions.');
    }

    /**
     * Retrieve the permissions of the user as an array.
     *
     * @param object $user
     * @return array
     */
    private function getUserPermissions($user)
    {
        $userPermissions = [];

        // Get roles and permissions associated with each role
        $roles = $user->roles()->get();

        foreach ($roles as $role) {
            $rolePermissions = $role->permissions()->get();

            foreach ($rolePermissions as $permission) {
                if (!in_array($permission->name, $userPermissions)) {
                    $userPermissions[] = $permission->name;
                }
            }
        }

        // Get direct permissions assigned to the user
        $permissions = $user->permissions()->get()->toArray();

        foreach ($permissions as $permission) {
            if (!in_array($permission['name'], $userPermissions)) {
                $userPermissions[] = $permission['name'];
            }
        }

        return $userPermissions;
    }
}

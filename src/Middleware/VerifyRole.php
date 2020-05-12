<?php


namespace Saritasa\Roles\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Saritasa\Roles\IHasRole;
use Saritasa\Roles\Models\Role;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyRole
{
    /**
     * Security Guard, that checks, if user if authenticated or not
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth Security Guard, that checks, if user if authenticated or not
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request HTTP Request
     * @param Closure $next Next middleware handler
     * @param array ...$roles If user doesn't have any of these roles, access will be denied
     *
     * @return mixed
     *
     * @throws AccessDeniedHttpException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$this->auth->check()) {
            throw new AccessDeniedHttpException(trans('roles::errors.not_logged_in'));
        }

        $user = $this->auth->user();

        if ($user instanceof IHasRole) {
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return $next($request);
                }
            }
        }

        $labels = [];
        foreach ($roles as $role) {
            if (is_int($role) || is_string($role) && preg_match('/^\d+$/', $role)) {
                $labels[] = Role::find($role)->name ?: $role;
            } elseif ($role instanceof Model) {
                $labels[] = $role->name;
            } else {
                $labels[] = $role;
            }
        }

        throw new AccessDeniedHttpException(trans_choice('roles::errors.role_required', count($labels), [
            'role' => implode(', ', $labels)
        ]));
    }
}

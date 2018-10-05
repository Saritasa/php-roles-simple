<?php


namespace Saritasa\Roles\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyRole
{
    /**
     * Secutity Guard, that checks, if user if authenticated or not
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth Secutity Guard, that checks, if user if authenticated or not
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request HTTP Request
     * @param  \Closure $next Next middleware handler
     * @param array ...$roles If user doesn't have any of these roles, access will be denied
     * @throws AccessDeniedHttpException
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$this->auth->check()) {
            throw new AccessDeniedHttpException(trans('roles::errors.not_logged_in'));
        }
        /* @var  User $user */
        $user = $this->auth->user();

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        throw new AccessDeniedHttpException(trans('roles::errors.role_required', ['role' => implode(', ', $roles)]));
    }
}

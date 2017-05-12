<?php


namespace Saritasa\Roles\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyRole
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int|string $role
     * @return mixed
     * @throws AccessDeniedHttpException
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($this->auth->check()) {
            throw new AccessDeniedHttpException(trans('roles::errors.not_logged_in'));
        }
        /* @var  User $user */
        $user = $this->auth->user();
        if ($user->hasRole($role)) {
            return $next($request);
        }

        throw new AccessDeniedHttpException(trans('roles::errors.role_required', ['role' => $role]));
    }
}
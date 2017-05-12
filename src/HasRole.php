<?php

namespace Saritasa\Roles;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ReflectionClass;
use Saritasa\Exceptions\NotImplementedException;

/**
 * Trait to add to your User model
 */
trait HasRole
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getRole(): Role
    {
        return (!$this->role) ? $this->role = $this->role()->get() : $this->role;
    }

    public function hasRole($role): bool
    {
        if (is_int($role)) {
            return $this->role_id == $role;
        } else if (is_string($role)) {
            return $this->role->name == $role;
        } else {
            throw new NotImplementedException("function hasRole() accepts either int (role_id) or string (role name). "
                .gettype($role)." was given");
        }
    }
}

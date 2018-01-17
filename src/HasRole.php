<?php

namespace Saritasa\Roles;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Saritasa\Exceptions\NotImplementedException;
use Saritasa\Roles\Models\Role;

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
        } elseif (is_string($role)) {
            return strcasecmp($this->role->slug, $role) == 0;
        } else {
            throw new NotImplementedException("function hasRole() accepts either int (role_id) or string (role name). "
                .gettype($role)." was given");
        }
    }
}

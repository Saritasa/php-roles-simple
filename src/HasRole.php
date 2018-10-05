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
    /**
     * Relation between Users and Roles tables.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get user's role entity
     *
     * @return Role
     */
    public function getRole(): Role
    {
        return (!$this->role) ? $this->role = $this->role()->get() : $this->role;
    }

    /**
     * Check, if user has specified role

     * @param int|string $role Role to check. Either role ID or role slug.
     *                         If int is passed, then it's role ID, and check is performed without loading Role model.
     *                         Otherwise, it will require to load role relation
     * @return boolean
     * @throws NotImplementedException
     */
    public function hasRole($role): bool
    {
        if ($this->role_id) {
            if (is_int($role)) {
                return $this->role_id == $role;
            } elseif (is_string($role)) {
                return strcasecmp($this->role->slug, $role) == 0;
            } else {
                throw new NotImplementedException("function hasRole() accepts either int (role_id) or string (role name). "
                    . gettype($role) . " was given");
            }
        }

        return false;
    }
}

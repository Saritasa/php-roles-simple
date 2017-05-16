<?php

namespace Saritasa\Roles;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Saritasa\Roles\Models\Role;

interface IHasRole
{
    /**
     * Relation between Users and Roles tables.
     * 
     * @return BelongsTo
     */    
    public function role(): BelongsTo;

    /**
     * Get user's role entity 
     * 
     * @return Role
     */
    public function getRole(): Role;

    /**
     * Check, if user has specified role
     * 
     * @param int|string $role
     * @return bool
     */
    public function hasRole($role): bool;
}

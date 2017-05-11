<?php

namespace Saritasa\Roles;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface IHasRole
{
    public function role(): BelongsTo;

    public function getRole(): Role;

    public function hasRole($role): bool;
}

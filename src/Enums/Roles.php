<?php

namespace Saritasa\Roles\Enums;

use Saritasa\Enum;

/**
 * Basic roles enumeration: User & Admin.
 */
class Roles extends Enum
{
    const NONE = 0;
    const USER = 1;
    const ADMIN = 2;
}

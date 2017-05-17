<?php

namespace Saritasa\Roles\Enums;

use Saritasa\Enum;

/**
 * Basic roles enumeration: User & Admin.
 */
class Roles extends Enum
{
    const None = 0;
    const User = 1;
    const Admin = 2;
}

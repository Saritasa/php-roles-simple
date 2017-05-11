<?php

namespace Saritasa\Roles\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * User role
 *
 * @property int $id Identifier
 */
class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = false;

    protected $visible = [
        'id',
        'name'
    ];
}

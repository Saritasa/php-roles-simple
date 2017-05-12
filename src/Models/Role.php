<?php

namespace Saritasa\Roles\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * User role
 *
 * @property int $id Identifier
 * @property string $name Role name, visible to user
 * @property string $slug Role human-readable identifier
 */
class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = false;

    protected $visible = [
        'id',
        'name'
    ];

    protected $fillable = [
        'name',
        'slug'
    ];
}

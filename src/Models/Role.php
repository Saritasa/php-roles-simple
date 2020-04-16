<?php

namespace Saritasa\Roles\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * User role. Can be used to segregate allowed functionality in application.
 *
 * @property integer $id Unique role identifier
 * @property string $name Role name, visible to user
 * @property string $slug Role human-readable identifier
 *
 * @mixin Eloquent
 */
class Role extends Model
{
    const ID = 'id';
    const NAME = 'name';
    const SLUG = 'slug';

    protected $table = 'roles';
    public $timestamps = false;

    protected $visible = [
        self::ID,
        self::NAME,
    ];

    protected $fillable = [
        self::ID,
        self::NAME,
        self::SLUG,
    ];
}

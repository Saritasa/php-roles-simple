# Saritasa Roles for Laravel

[![Build Status](https://travis-ci.org/Saritasa/php-roles-simple.svg?branch=master)](https://travis-ci.org/Saritasa/php-roles-simple)
[![Release](https://img.shields.io/github/release/saritasa/php-roles-simple.svg)](https://github.com/Saritasa/php-roles-simple/releases)
[![PHPv](https://img.shields.io/packagist/php-v/saritasa/roles-simple.svg)](http://www.php.net)
[![Downloads](https://img.shields.io/packagist/dt/saritasa/roles-simple.svg)](https://packagist.org/packages/saritasa/roles-simple)

Simplified implementation of user roles for Laravel applications:
User has role_id field, and corresponding roles lookup table exists.

## Usage

Install the ```saritasa/php-roles-simple``` package:

```bash
$ composer require saritasa/php-roles-simple
```

If you use Laraval 5.4 or less,
or 5.5+ with [package discovery](https://laravel.com/docs/5.5/packages#package-discovery) disabled,
add the RolesServiceProvider service provider in ``config/app.php``:

```php
'providers' => array(
    // ...
    Saritasa\Roles\RolesServiceProvider::class,
)
```

Then publish DB migrations:

```bash
php artisan vendor:publish --provider=Saritasa\\Roles\\RolesServiceProvider
```

## Available classes

### HasRoles
Provides hasRole method;

**Example**:
```php
class User extends Model implements IHasRoles
{
    uses HasRoles
}
```
then somewere in code:
```php
if ($user->hasRole(Roles::ADMIN)) { ... }}
$user->role->name;
```

**hasRole($role)** method can accept either role ID (integer) or
role slug (string).
Using role ID is a bit faster, because does not require reading role
record from lookup table.

### Role (model)
You can use built-in class *Saritasa\Roles\Models\Role* to list of models
or create new roles in migrations or in code.

Role model contains 3 fields:

* **id** (integer) - primary key
* **name** (string) - supposed to be visible to user and may change, as needed.
May contain any characters (including spaces), in any case.
Do not use role name as identifier (ex. to search by it).
* **slug** (string) - human-readable role identifier, supposed to be constant,
while name can be changed. You can reference role by slug in code (ex. in *hasRole()* method).
It's recommended to keep slugs in lowercase,
use underscore or dash instead of spaces.

```
class AddRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::firstOrCreate(['name' => 'User', 'slug' => 'user']);
        Role::firstOrCreate(['name' => 'Admin', 'slug' => 'admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereSlug('user')->delete();
        Role::whereSlug('admin')->delete();
    }
}
```

### Roles (enum)
Package contains enum *Saritasa\Roles\Enums\Roles*, which has 2 predefined
roles: User and Admin, which is suitable for many applications.

But you are not limited to these roles, you can define your own enum
(extending this one or create new from scratch) and use it.

```
class Roles extends Enum
{
    const USER = 1;
    const SUPER_ADMIN = 2;
    const SCHOOL_ADMIN = 3;
}
```

## Middleware
You can use middleware in routes to limit access to certain pages:
```
Router::get('/admin', [
    'as' => 'admin.dashboard',
    'middlware' => 'role:admin'
]
```
Middleware with alias is registered by service provider, no need to register it manually.

Format is *role:role_slug1,role_slug2,role_slug3*.

If user does not have any of required roles, **AccessDeniedHttpException** will be thrown

## Contributing

1. Create fork, checkout it
2. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)** -
    run [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to ensure, that code follows style guides
3. **Cover added functionality with unit tests** and run [PHPUnit](https://phpunit.de/) to make sure, that all tests pass
4. Update [README.md](README.md) to describe new or changed functionality
5. Add changes description to [CHANGES.md](CHANGES.md) file. Use [Semantic Versioning](https://semver.org/) convention to determine next version number.
6. When ready, create pull request

### Make shortcuts

If you have [GNU Make](https://www.gnu.org/software/make/) installed, you can use following shortcuts:

* ```make cs``` (instead of ```php vendor/bin/phpcs```) -
    run static code analysis with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    to check code style
* ```make csfix``` (instead of ```php vendor/bin/phpcbf```) -
    fix code style violations with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    automatically, where possible (ex. PSR-2 code formatting violations)
* ```make test``` (instead of ```php vendor/bin/phpunit```) -
    run tests with [PHPUnit](https://phpunit.de/)
* ```make install``` - instead of ```composer install```
* ```make all``` or just ```make``` without parameters -
    invokes described above **install**, **cs**, **test** tasks sequentially -
    project will be assembled, checked with linter and tested with one single command

## Resources

* [Bug Tracker](http://github.com/saritasa/php-roles-simple/issues)
* [Code](http://github.com/saritasa/php-roles-simple)
* [Changes History](CHANGES.md)
* [Authors](http://github.com/saritasa/php-roles-simple/contributors)

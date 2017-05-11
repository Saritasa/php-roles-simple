# Saritasa Roles for Laravel

Simplified implementation of user roles for Laravel applications:
User has role_id field, and corresponding roles table exists

## Usage

Install the ```saritasa/php-roles-simple``` package:

```bash
$ composer require saritasa/php-roles-simple
```

Add the RolesServiceProvider service provider ``config/app.php``:

```php
'providers' => array(
    // ...
    Saritasa\Roles\RolesServiceProvider::class,
)
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
if ($user->hasRole(Roles::Admin)) { ... }}
$user->role->name;
```

## Contributing

### Requirements
This package must:
* Do not depend on any framework or library
* Do not depend on other Saritasa packages
* Do not register any providers

1. Create fork
2. Checkout fork
3. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)**
4. Update README.md to describe new or changed functionality. Add changes description to CHANGE file.
5. When ready, create pull request

## Resources

* [Bug Tracker](http://github.com/saritasa/php-common/issues)
* [Code](http://github.com/saritasa/php-common)

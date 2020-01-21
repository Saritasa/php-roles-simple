# Changes History

1.1.0
-----
Declare compatibility with Laravel 6

1.0.9
-----
- Use IHasRole interface in the middleware (rather than User class)


1.0.8
-----
- Added check if user role exists in the \Saritasa\Roles\HasRole::hasRole()

1.0.7
-----
- Enable Laravel's package discovery https://laravel.com/docs/5.5/packages#package-discovery
- Do not require minimum-stability of packages

1.0.6
-----
- Fixes
- Allow to specify list of possible roles
- Update README

1.0.5
-----
Update dependencies versions

1.0.4
- Update README

1.0.3
-----
- Fix namespace

1.0.2
-----
- Add slug to role

1.0.1
-----
- Fixes, DB Migrations

1.0.0
-----

- Initial version:
HasRole trait, ServiceProvider

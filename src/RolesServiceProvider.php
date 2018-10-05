<?php

namespace Saritasa\Roles;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Saritasa\Roles\Middleware\VerifyRole;

class RolesServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'roles');
        $router->aliasMiddleware('role', VerifyRole::class);
        $this->registerBladeExtensions();

        if ($this->app->runningInConsole()) {
            $this->declarePublishedFiles();
        }
    }

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    private function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('role', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->hasRole{$expression}): ?>";
        });

        $blade->directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }

    private function declarePublishedFiles(): void
    {
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations')
        ], 'migrations');
    }
}

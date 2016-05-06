<?php namespace Vis\Rating;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Vis\Ratings\Rating;

class RatingServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/../vendor/autoload.php';

        $this->setupRoutes($this->app->router);
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'rating');
        $this->publishes([
            __DIR__
            . '/published' => public_path('packages/vis/rating'),
            __DIR__ . '/config' => config_path('rating/')
        ], 'rating');

        $this->publishes([
            __DIR__
            . '/published' => public_path('packages/vis/rating')
        ], 'rating_public');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/rating'),
        ], 'rating_views');

        $this->publishes([
            realpath(__DIR__.'/Migrations') => $this->app->databasePath().'/migrations',
        ]);

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routers.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['rating'] = $this->app->share(function ($app) {
            return new Rating();
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Rating', 'Vis\Ratings\Facades\Rating');
        });
    }

    public function provides()
    {
    }
}




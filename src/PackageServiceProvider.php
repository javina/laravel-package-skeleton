<?php

namespace Vendor\Package;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Vendor\Package\PackageFacade;

class PackageServiceProvider extends ServiceProvider
{

    /**
     * If specified, this namespace is automatically applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Vendor\Package\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuration
        $this->handleConfigs();
        // Routes
        $this->handleRoutes($this->app->router);
        // Migrations
        $this->hanldeMigrations();
        // Views
        //$this->handleViews();
        // View composers
        //$this->handleViewComposers();
        // Commands
        //$this->handleCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         // Load config File
        $this->mergeConfigFrom(__DIR__ . '/../config/package.php', 'package');

        // Bind
        $this->app->singleton('package_facade', function ($app) {
            return new PackageFacade(config('package_facade'));
        });
    }

    /**
     * handle Package Config File
     *
     * @return void
     **/
    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/package.php';

        $this->publishes([
            $configPath => config_path('package.php')
        ]);
    }

    /**
     * handle Routes file
     *
     * @return void
     * @author
     **/
    public function handleRoutes()
    {
        Route::group([
            //'prefix' => config('some.option.array'),
            'namespace' => $this->namespace,
            'middleware' => ['web'],
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        });
    }

    /**
     * hanlde Migrations files
     *
     * @return void
     * @author
     **/
    public function hanldeMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    /**
     * handle View files
     *
     * @return void
     * @author
     **/
    public function handleViews()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/Views', 'package_facade');

        // Publishing Views
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/vendor/package'),
        ]);
    }

    /**
     * handle View Composers
     *
     * @return void
     **/
    public function handleViewComposers()
    {
        /*
        View::composer(
            [
                //'model::view',
            ],
            SampleComposerClass::class
        );
        */
    }

    /**
     * handle Commands
     *
     * @return void
     **/
    public function handleCommands()
    {
        // Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                //Commands\SampleCommandClass::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['package_facade'];
    }
}

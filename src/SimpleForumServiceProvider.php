<?php

namespace Ozgurince\SimpleForum;

use Illuminate\Support\ServiceProvider;

class SimpleForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'simpleforum');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/simpleforum'),
        ], 'public');
    }
}

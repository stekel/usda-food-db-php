<?php

namespace stekel\FoodDatabase\Laravel\Providers;

use stekel\FoodDatabase\USDA;
use stekel\FoodDatabase\USDAClient;
use Illuminate\Support\ServiceProvider;

class FoodDatabaseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/usda_food_db.php' => config_path('usda_food_db.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/usda_food_db.php', 'usda_food_db'
        );
        
        $this->app->singleton('usda', function($app) {
            
            return new USDA(new USDAClient(config('usda_food_db.api_key')));
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'usda'
        ];
    }
}

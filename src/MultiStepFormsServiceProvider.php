<?php

namespace Infinitypaul\MultiStep;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Infinitypaul\MultiStep\Controller\MultiStepManager;
use Infinitypaul\MultiStep\Routing\PendingMultiStepRegister;
use Infinitypaul\MultiStep\Store\Contracts\StepStorage;
use Infinitypaul\MultiStep\Store\SessionStorage;

class MultiStepFormsServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        //$this->loadRoutesFrom(__DIR__.'/routes.php');

        Route::macro('multistep', function ($uri, $controller){
            return new  PendingMultiStepRegister($uri, $controller);
        });


        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/steps.php' => config_path('steps.php'),
            ], 'config');

            if (!class_exists('CreateMultiStepsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_multisteps_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_multisteps_table.php')
                ], 'migrations');
            }


            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/steps.php', 'steps');


        // Register the main class to use with the facade
        $this->app->singleton('laravel-multistep-forms', function ($app) {
            return new MultiStepManager($app);
        });


    }
}

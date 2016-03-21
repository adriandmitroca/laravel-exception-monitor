<?php

namespace Adriandmitroca\LaravelExceptionMonitor;

use Adriandmitroca\LaravelExceptionMonitor\ExceptionMonitor;
use Illuminate\Support\ServiceProvider;

class ExceptionMonitorServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/exception-monitor.php' => config_path('exception-monitor.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-exception-monitor');
    }


    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/exception-monitor.php', 'exception-monitor');
        $this->app->singleton('exception-monitor', function () {
            return new ExceptionMonitor;
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'exception-monitor' ];
    }
}
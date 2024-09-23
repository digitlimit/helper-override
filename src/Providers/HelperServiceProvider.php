<?php

namespace Digitlimit\HelperOverride\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Optionally, you can load routes, views, etc. here
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register your helpers here
        $helpers = glob(__DIR__ . '/../Helpers/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}

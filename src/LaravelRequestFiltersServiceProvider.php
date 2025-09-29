<?php

namespace Curvestech\LaravelRequestFilters;

use Curvestech\LaravelRequestFilters\Console\Commands\MakeFilterCommand;
use Illuminate\Support\ServiceProvider;

class LaravelRequestFiltersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilterCommand::class,
            ]);
        }
    }
}

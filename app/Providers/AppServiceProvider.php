<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\CurrencyRepositoryInterface',
            'App\Services\CurrencyRepository'
        );
    }
}

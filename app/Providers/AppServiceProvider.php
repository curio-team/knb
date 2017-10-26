<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GitHub;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (!\Auth::check())
        {


        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}

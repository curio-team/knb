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
        $houses = \App\House::sortByPoints(4);
        $tags = \App\Tags::all();
        $rankedUsers = \App\User::sortByPoints(10);

        \View::share([
            'houses'        => $houses,
            'tags'          => $tags,
            'rankedUsers'   => $rankedUsers
        ]);
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GitHub;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // global sidebar values for each page.

        if (\Schema::hasTable('houses'))
        {
            $houses = \App\House::sortByPoints(4);
            $tags = \App\Tags::all();
            $rankedUsers = \App\User::sortByPoints(10);

            \View::share([
                'houses'    => $houses,
                'tags'      => $tags,
                'rankedUsers'     => $rankedUsers
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

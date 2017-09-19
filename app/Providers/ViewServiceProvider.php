<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function(){

            $houses = \App\House::sortByPoints();



            $tags = \App\Tags::all();

            $rankedUsers = \App\User::orderBy('points', 'DESC')->take(10)->get();


            \View::share([
                'houses'        => $houses,
                'tags'          => $tags,
                'rankedUsers'   => $rankedUsers
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}

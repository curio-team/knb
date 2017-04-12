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
            $houses = \App\House::all();
            $tags = \App\Tags::all();
            \View::share([
                'houses'    => $houses,
                'tags'      => $tags
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

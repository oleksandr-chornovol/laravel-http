<?php

namespace App\Providers;

use App\Socialite\Providers\SpotifyProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $socialite = app()->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend('spotify',
            function ($app) use ($socialite) {
                $config = $app['config']['services.spotify'];
                return $socialite->buildProvider(SpotifyProvider::class, $config);
            }
        );
    }
}

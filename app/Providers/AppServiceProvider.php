<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use danog\MadelineProto\API;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $api = new API('session.madeline');
        $this->app->instance(
            API::class,$api
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

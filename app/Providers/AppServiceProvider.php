<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Image\Providers\ImageServiceProvider;
use Modules\Mission\Providers\MissionServiceProvider;
use Modules\User\Providers\UserServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MissionServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
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

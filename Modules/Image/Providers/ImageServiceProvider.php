<?php

namespace Modules\Image\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Image\Services\ImageUserService;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageUserServiceInterface::class, ImageUserService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

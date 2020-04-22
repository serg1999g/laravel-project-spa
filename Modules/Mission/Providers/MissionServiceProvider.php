<?php

namespace Modules\Mission\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;
use Modules\Mission\Repositories\MissionRepository;
use Modules\Mission\Services\Interfaces\MissionServiceInterface;
use Modules\Mission\Services\MissionService;

class MissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MissionRepositoryInterface::class, MissionRepository::class);
        $this->app->bind(MissionServiceInterface::class, MissionService::class);
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PermissionRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\RoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
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

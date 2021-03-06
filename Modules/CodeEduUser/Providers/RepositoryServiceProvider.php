<?php

namespace CodeEduUser\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeEduUser\Repositories\UserRepository::class, \CodeEduUser\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\CodeEduUser\Repositories\RoleRepository::class, \CodeEduUser\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\CodeEduUser\Repositories\PermissionRepository::class, \CodeEduUser\Repositories\PermissionRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}

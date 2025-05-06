<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vehiculo::class => \App\Policies\VehiculoPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('read-vehicles', [\App\Policies\VehiculoPolicy::class, 'view']);
        Gate::define('create-vehicles', [\App\Policies\VehiculoPolicy::class, 'create']);
        Gate::define('update-vehicles', [\App\Policies\VehiculoPolicy::class, 'update']);
        Gate::define('delete-vehicles', [\App\Policies\VehiculoPolicy::class, 'delete']);
    }
}

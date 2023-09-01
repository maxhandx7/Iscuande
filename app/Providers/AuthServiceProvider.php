<?php

namespace App\Providers;

use App\Policies\UserTypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', [UserTypePolicy::class, 'isAdmin']);
        Gate::define('paciente-only', [UserTypePolicy::class, 'isPaciente']);
        Gate::define('medico-only', [UserTypePolicy::class, 'isMedico']);
    }
}

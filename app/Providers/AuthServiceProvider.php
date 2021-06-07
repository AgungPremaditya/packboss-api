<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Admin role
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        // Operator role
        Gate::define('isOperator', function($user){
            return $user->role == 'operator';
        });

        //User role
        Gate::define('isUser', function($user){
            return $user->role == 'user';
        });
    }
}

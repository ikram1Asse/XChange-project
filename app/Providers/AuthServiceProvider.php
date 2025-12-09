<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Configure Auth to use the Utilisateur model
        config(['auth.providers.users.model' => Utilisateur::class]);
        config(['auth.providers.users.table' => 'utilisateurs']);

        Auth::provider('eloquent', function ($app, array $config) {
            return new \Illuminate\Auth\EloquentUserProvider($app['hash'], Utilisateur::class);
        });
    }
}

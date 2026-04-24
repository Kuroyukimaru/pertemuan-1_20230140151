<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
        |---------------------------------------
        | ADMIN ONLY GATE
        |---------------------------------------
        */
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        /*
        |---------------------------------------
        | EXPORT PRODUCT (ADMIN ONLY)
        |---------------------------------------
        */
        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });
    }
}
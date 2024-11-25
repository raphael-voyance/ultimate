<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\Policies\AuthorizationRoles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Gate::define('admin', [AuthorizationRoles::class, 'admin']);
        Gate::define('consultant', [AuthorizationRoles::class, 'consultant']);
        Gate::policy(Invoice::class, InvoicePolicy::class);
    }
}

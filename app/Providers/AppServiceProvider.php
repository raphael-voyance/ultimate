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

        ini_set('post_max_size', '12M');
        ini_set('upload_max_filesize', '10M');

        Gate::define('admin', [AuthorizationRoles::class, 'admin']);
        Gate::define('consultant', [AuthorizationRoles::class, 'consultant']);
        Gate::policy(Invoice::class, InvoicePolicy::class);
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('doctorControl', function (User $user) {
            return $user -> rol == 'doctor' ;
        });

        Gate::define('adminControl', function (User $user) {
            return $user -> rol == 'admin' ;
        });
    }
}

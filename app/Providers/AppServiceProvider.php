<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // 1. TAMBAH BARIS NI KAT ATAS

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
        // 2. TAMBAH KOD NI SUPAYA DIA PAKSA GUNA HTTPS MASA LIVE
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}

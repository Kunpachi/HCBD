<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Schema; // contoh jika perlu defaultStringLength

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Tempatkan binding/registrasi service disini jika diperlukan
        // $this->app->singleton(...);
    }

    public function boot(): void
    {
        // Inisialisasi aplikasi saat boot
        // Schema::defaultStringLength(191);
    }
}
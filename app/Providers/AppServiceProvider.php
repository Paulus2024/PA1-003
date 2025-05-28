<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log; // ✅ Tambahkan ini
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Debug tebakan plural Laravel
        Log::info('Plural dari peminjaman: ' . Str::plural('peminjaman'));
    }
}

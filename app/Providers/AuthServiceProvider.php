<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('approve-peminjaman', function ($user) {
            // Logika untuk menentukan apakah user boleh menyetujui peminjaman
            return $user->usertype === 'bumdes';
        });

        Gate::define('reject-peminjaman', function ($user) {
            // Logika untuk menentukan apakah user boleh menolak peminjaman
            return $user->usertype === 'bumdes';
        });

    }
}

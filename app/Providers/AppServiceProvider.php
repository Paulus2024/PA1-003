<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log; // ✅ Tambahkan ini
use Illuminate\Support\Str;

use App\Models\Message;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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

        View::composer('*', function ($view) {
            $unreadMessagesCount = Message::where('is_approved', false)->count();
            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });

        DB::listen(function ($query) {
            Log::info('Query Executed', [
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time
            ]);
        });

        Notification::creating(function ($notification) {
            dd($notification);
        });

    }
}

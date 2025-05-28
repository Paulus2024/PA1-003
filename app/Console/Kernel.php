<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DeleteOldNotifications;//import command


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('messages:delete-old')->everyMinute();

        $schedule->command(DeleteOldNotifications::class)//menentukan Command yang akan di jalankan oleh scheduler
        ->daily(); //jalankan setiap hari.  bisa menggunakan opsi lain seperti hourly(), weekly(), dll.
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

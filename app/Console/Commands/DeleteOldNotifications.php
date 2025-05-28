<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus notifikasi yang sudah di baca dan lebih dari 30 hari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('notifications')
        ->whereNotNull('read_at')
        ->where('read_at', '<', now()->subDays(30))
        ->delete();

        $this->info('Old notifications deleted successfully.');
        return Command::SUCCESS;
    }
}

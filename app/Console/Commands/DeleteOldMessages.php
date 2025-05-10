<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Carbon\Carbon;

class DeleteOldMessages extends Command
{
    protected $signature = 'messages:delete-old';
    protected $description = 'Delete contact messages older than 24 hours';

    public function handle()
    {
        Message::where('created_at', '<', Carbon::now()->subDay())->delete();

        $this->info('Pesan yang lebih dari 24 jam telah dihapus.');
    }
}

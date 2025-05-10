<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Carbon\Carbon;

class DeleteOldMessages extends Command
{
    protected $signature = 'messages:delete-old';
    protected $description = 'Hapus pesan yang berumur lebih dari 24 jam';

    public function handle()
    {
        $deleted = Message::where('created_at', '<', now()->subHours(24))->delete();

        $this->info("Pesan lama yang dihapus: $deleted");
    }
}

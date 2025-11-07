<?php

namespace App\Console\Commands;

use App\Models\UserSession;
use Illuminate\Console\Command;

class CleanExpiredSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-expired-sessions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus session yang sudah expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = UserSession::where('expires_at', '<', now())->delete();
        $this->info("{$count} sesi expired telah dihapus");
    }
}

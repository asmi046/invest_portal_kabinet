<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoskeyQueueMonitoringService;

class QueueGetTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue-get:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $queueService = new GoskeyQueueMonitoringService();
        $queueService->getQueue();
    }
}

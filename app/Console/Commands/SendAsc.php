<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoskeyQueueMonitoringService;

class SendAsc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-asc:test';

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
        $messageId = $this->ask('Введите messageId:');
        $service = new GoskeyQueueMonitoringService();
        $service->sendAscRequest($messageId );
    }
}

<?php

namespace App\Console\Commands;

use Log;
use App\Models\GoskeyRegistry;
use Illuminate\Console\Command;
use App\Models\GoskeyQueueMessage;
use App\Services\GoskeyResultAnalizator;
use App\Services\GoskeyQueueMonitoringService;

class QueueGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение сообщений из очереди СМЭВ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = microtime(true);
        $rez = app(GoskeyQueueMonitoringService::class)->messageRecognition();
        $this->info(print_r($rez, true));
        $end = microtime(true);
        $this->info('Время выполнения: ' . round($end - $start, 3) . ' сек.');
    }
}

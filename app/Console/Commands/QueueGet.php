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
        $rez = app(GoskeyQueueMonitoringService::class)->getQueue();
        $analyzedResponse = GoskeyResultAnalizator::analyzeResponse($rez);

        if ($analyzedResponse['original_message_id'] == null) {
            $this->info('Очередь пуста');
        } else {
            GoskeyQueueMessage::create($analyzedResponse);

            $updateResult = 0;
            if ($analyzedResponse['type'] === 'error') {
                $updateResult = GoskeyRegistry::where('message_id', $analyzedResponse['original_message_id'])
                ->update(['status' => 'error', 'error_code' => $analyzedResponse['error_code'], 'error_message' => $analyzedResponse['error_message'], 'last_check_at' => now()]);
            } else {
                $updateResult = GoskeyRegistry::where('message_id', $analyzedResponse['original_message_id'])
                ->update(['status' => $analyzedResponse['state_message'], 'status_code' => $analyzedResponse['temporary_code'], 'last_check_at' => now()]);
            }

            if ($updateResult == 0) {
                Log::channel('goskey')->info('Не обновлено в регистре, возможно запись в базе удалена (message_id '.$analyzedResponse['original_message_id'].')');
                $this->info('Не обновлено в регистре, возможно запись в базе удалена (message_id '.$analyzedResponse['original_message_id'].')');
            }

            $ask = app(GoskeyQueueMonitoringService::class)->sendAscRequest($analyzedResponse['message_id']);
            $askResult = GoskeyResultAnalizator::analyzeAsk($ask);

            if ($askResult['error'] == true) {
                Log::channel('goskey')->info('Ошибка при подтверждении сообщения из очереди (message_id '.$analyzedResponse['message_id'].'): '.$askResult['error_message']);
                $this->info('Ошибка при подтверждении сообщения из очереди (message_id '.$analyzedResponse['message_id'].'): '.$askResult['error_message']);
            }
        }


        $end = microtime(true);
        $this->info('Время выполнения: ' . round($end - $start, 3) . ' сек.');
    }
}

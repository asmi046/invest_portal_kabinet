<?php

namespace App\Services;

use App\Models\GoskeyRegistry;
use App\Services\XmlSignService;
use App\Services\CurlSmevService;
use App\Models\GoskeyQueueMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Services\SmevEnvvelopeService;
use App\Services\GoskeyResultAnalizator;

class GoskeyQueueMonitoringService
{
    protected SmevEnvvelopeService $smevService;
    protected CurlSmevService $client;
    protected XmlSignService $xmlSignService;

    public function __construct(
        SmevEnvvelopeService $smevService,
        CurlSmevService $client,
        XmlSignService $xmlSignService
    ) {
        $this->smevService = $smevService;
        $this->client = $client;
        $this->xmlSignService = $xmlSignService;
    }

    /**
     * Start the monitoring server.
     *
     * @return void
     */
    public function getQueue()
    {

        $envelope = $this->smevService->createGetResponseEnvelope();

        $xml = $this->xmlSignService->signXmlContentViaNetwork($envelope);

        $response = $this->client->doRequest($xml, 'urn:GetResponse');

        $rez = $this->client->parseSoapEnvelope($response);

        return $rez;
    }

    public function sendAscRequest(string $messageId)
    {
        $envelope = $this->smevService->createAscRequest($messageId, true);
        $xml = $this->xmlSignService->signXmlContentViaNetwork($envelope);
        $response = $this->client->doRequest($xml, 'urn:Ask');

        return $this->client->parseSoapEnvelope($response);
    }

    public function messageRecognition() {
        $rez = $this->getQueue();
        $analyzedResponse = GoskeyResultAnalizator::analyzeResponse($rez);

        $result = [];

        if ($analyzedResponse['original_message_id'] == null) {
            $result[] = 'Очередь пуста';
        } else {
            GoskeyQueueMessage::create($analyzedResponse);

            $updateResult = 0;
            if ($analyzedResponse['type'] === 'error') {
                $updateResult = GoskeyRegistry::where('message_id', $analyzedResponse['original_message_id'])
                ->update(['status' => $analyzedResponse['error_message'], 'error_code' => $analyzedResponse['error_code'], 'error_message' => $analyzedResponse['error_message'], 'last_check_at' => now()]);
                $result[] = 'Ошибка: '.$analyzedResponse['error_message'];
            } else {
                $updateResult = GoskeyRegistry::where('message_id', $analyzedResponse['original_message_id'])
                ->update([
                    'status' => $analyzedResponse['state_message'],
                    'status_code' => $analyzedResponse['temporary_code'],
                    'signatures' => isset($analyzedResponse['signatures'])?json_encode($analyzedResponse['signatures']):null,
                    'last_check_at' => now()
                ]);
                $result[] = 'Статус: '.$analyzedResponse['state_message'];
            }

            if ($updateResult == 0) {
                Log::channel('goskey')->info('Не обновлено в регистре, возможно запись в базе удалена (message_id '.$analyzedResponse['original_message_id'].')');
                $result[] = 'Не обновлено в регистре, возможно запись в базе удалена (message_id '.$analyzedResponse['original_message_id'].')';
            }

            $ask = app(GoskeyQueueMonitoringService::class)->sendAscRequest($analyzedResponse['message_id']);
            $askResult = GoskeyResultAnalizator::analyzeAsk($ask);

            if ($askResult['error'] == true) {
                Log::channel('goskey')->info('Ошибка при подтверждении сообщения из очереди (message_id '.$analyzedResponse['message_id'].'): '.$askResult['error_message']);
                $result[] = 'Ошибка при подтверждении сообщения из очереди (message_id '.$analyzedResponse['message_id'].'): '.$askResult['error_message'];
            }
        }

        return $result;
    }
}

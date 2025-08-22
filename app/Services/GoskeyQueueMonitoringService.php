<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class GoskeyQueueMonitoringService
{
    /**
     * Start the monitoring server.
     *
     * @return void
     */
    public function getQueue(): void
    {
        $smevService = new SmevEnvvelopeService();
        $client = new CurlSmevService(); // сервис для отправки пакета
        $envelope = $smevService->createGetResponseEnvelope();

        $address = config('cryptography.cryptcp_xml_address');
        $response = Http::attach(
            'file', $envelope, 'r.xml'
        )->asMultipart()->post($address, [
            'elementId' => 'SIGNED_BY_CALLER',
            'signatureElementName' => 'ns:CallerInformationSystemSignature',
        ]);

        if ($response->successful()) {
            $response = $client->doRequest($response->body(), 'urn:GetResponse');

            $rez = $client->parseSoapEnvelope($response, true);
            // File::put("q.xml", mb_convert_encoding($rez, 'UTF-8') );
            dd($rez);
        } else {
            throw new \Exception('Ошибка при отправке запроса: ' . $response->body());
        }
    }

    public function sendAscRequest(string $messageId): void
    {
        $client = new CurlSmevService();
        $smevService = new SmevEnvvelopeService();
        $envelope = $smevService->createAscRequest($messageId, true);

        dd($envelope);

        $response = $client->doRequest($envelope, 'urn:GetQueueStatus');

        if ($response) {
            $status = $client->parseSoapEnvelope($response, true);
            dd($status);
        } else {
            throw new \Exception('Ошибка при получении статуса очереди');
        }
    }
}

<?php

namespace App\Services;

use App\Services\XmlSignService;
use App\Services\CurlSmevService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Services\SmevEnvvelopeService;

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
}

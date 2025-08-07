<?php

namespace App\Services;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\DocumentType;
use App\Models\GoskeyRegistry;
use App\Services\XmlSignService;
use App\Services\CurlSmevService;
use App\Services\SmevEnvvelopeService;
use Illuminate\Support\Facades\Storage;

class GoskeyRegistryService
{

    protected $userData;
    protected $documentData;
    protected string $storagePath = 'goskey_registry';

    private function createEnvelopeFile(string $fileNamme, string $message_id)
    {
        $smevEnvelopeService = new SmevEnvvelopeService();
        $fileData = $smevEnvelopeService->createSendRequestEnvelope(uuid: $message_id, test: true,
        data: [
            '@Id' => Uuid::uuid1()->toString(),
            '@timestamp' => date('Y-m-d\TH:i:s+03:00'),
            'OID' => $this->userData->snils,
            'SNILS' => $this->userData->snils,
            'descDoc' => $this->documentData->name,
            'Backlink' => config('goskey.backlink'),
            '//AddData[0]/AttrValue' => 'Инвестиционный портал Курской Области',
        ],

        files: [
           [
                'Document' => [
                    'uuid' => '28a2624e-c59e-4d82-89c9-4db9d451bb7f',
                    'docId' => '7b3ad8aa-026b-40df-83f2-0b7969083456',
                    'mimeType' => 'application/pdf',
                    'description' => 'Договор'
                ],

                'Signature' => [

                        'docId' => '7b3ad8aa-026b-40df-83f2-0b7969083456',
                        'uuid' => '70f5753a-1747-4542-a673-e892d1204836',
                        'mimeType' => 'application/x-pkcs7-signature',
                        'description' => 'Подпись'

                ]
            ],
        ]);
        // dd($fileData, $fileNamme);

        Storage::disk('local')->put($fileNamme, $fileData);
    }

    public function createProcedure(string $main_file_path = "", int $document_type = null, int $user_id = null)
    {
        $xmlSignService = new XmlSignService();



        $this->userData = User::where('id', $user_id)->first();
        $this->documentData = DocumentType::where('id', $document_type)->first();

        $message_id = Uuid::uuid1()->toString();
        $short_identifier = date('Y_m_d_H_i_s') . '-' . uniqid();



        Storage::disk('local')->makeDirectory($this->storagePath. '/' . $short_identifier);
        $procedureDirPath = Storage::disk('local')->path($this->storagePath. '/' . $short_identifier);

        if (file_exists($main_file_path)) {
            copy($main_file_path, $procedureDirPath. '/' . basename($main_file_path));
        }

        $this->createEnvelopeFile(
            fileNamme: $this->storagePath. '/' . $short_identifier . '/envelope.xml',
            message_id: $message_id
        );

        $xmlSignService->signXmlFile(
            xmlFilePath: $procedureDirPath . '/envelope.xml',
            outputFilePath: $procedureDirPath . '/envelope_signed.xml'
        );

        $requestData = file_get_contents($procedureDirPath . '/envelope_signed.xml');

        $client = new CurlSmevService();
        $response = $client->doRequest($requestData, 'urn:SendRequest');
        $rez = $client->parseSoapEnvelope($response);

        GoskeyRegistry::create([
            'message_id' => $message_id,
            'short_identifier' => $short_identifier,
            'user_id' => $user_id,
            'document_type' => $document_type,
            'last_check_at' => null,
            'status' => 'created'
        ]);

        dd($rez);

        return null; // Заглушка, заменить реальной логикой
    }
}

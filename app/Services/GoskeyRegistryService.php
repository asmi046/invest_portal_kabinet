<?php

namespace App\Services;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\DocumentType;
use App\Models\GoskeyRegistry;
use App\Services\XmlSignService;
use App\Services\CurlSmevService;
use App\Services\SmevEnvvelopeService;
use App\Services\AttachmentSignService;
use Illuminate\Support\Facades\Storage;

class GoskeyRegistryService
{

    protected $userData;
    protected $documentData;
    protected array $files = [];
    protected array $attachmentFileList = [];

    protected string $storagePath = 'goskey_registry';

    private function loadAttachmentToS3(): void
    {
        foreach ($this->attachmentFileList as $file) {
            if (isset($file['Document'])) {
                Storage::disk('s3')->put($file['Document']['uuid'] . "/" . basename($file['Document']['fileName']), file_get_contents($file['Document']['localUrl']));
            }
            if (isset($file['Signature'])) {
                Storage::disk('s3')->put($file['Signature']['uuid'] . "/" . basename($file['Signature']['fileName']), file_get_contents($file['Signature']['localUrl']));
            }
        }
    }

    private function createAttachmentFileList()
    {
        $this->attachmentFileList = [];
        foreach ($this->files as $file) {
            $document = [];

            $docId = Uuid::uuid1()->toString();

            if (isset($file['Document'])) {
                $document['Document'] = [
                    'docId' => $docId,
                    'uuid' => Uuid::uuid1()->toString(),
                    'mimeType' => 'application/pdf',
                    'description' => basename($file['Document']),
                    'fileName' => basename($file['Document']),
                    'localUrl' => $file['Document'],
                    'digest' => $file['Digest'],
                ];
            }

            if (isset($file['Signature'])) {
                $document['Signature'] = [
                    'docId' => $docId,
                    'uuid' => Uuid::uuid1()->toString(),
                    'mimeType' => 'application/x-pkcs7-signature',
                    'description' => basename($file['Signature']),
                    'fileName' => basename($file['Signature']),
                    'localUrl' => $file['Signature'],
                    'digest' => $file['DigestSig'],
                ];
            }

            $this->attachmentFileList[] = $document;
        }
    }

    private function createEnvelopeFile(string $fileNamme, string $message_id)
    {
        $smevEnvelopeService = new SmevEnvvelopeService();
        $fileData = $smevEnvelopeService->createSendRequestEnvelope(uuid: $message_id, test: true,
        data: [
            '//s:RequestSignUkep/@Id' => Uuid::uuid1()->toString(),
            '//s:RequestSignUkep/@timestamp' => date('Y-m-d\TH:i:s+03:00'),
            '//s:OID' => $this->userData->oid,
            '//s:SNILS' => $this->userData->snils,
            '//s:routeNumber' => config('goskey.is_contur'),
            '//s:signExp' => date('Y-m-d\TH:i:s+03:00', strtotime('+10 hours')),
            '//s:descDoc' => $this->documentData->name,
            '//s:Backlink' => config('goskey.backlink'),
            '//s:AddData/s:AttrValue' => 'Инвестиционный портал Курской Области' // Пример обновления вложенного узла.
        ],

        files: $this->attachmentFileList
    );

        Storage::disk('local')->put($fileNamme, $fileData);
    }

    public function createProcedure(array $main_files = [], string $document_type = null, int $document_id = null, int $user_id = null)
    {
        $xmlSignService = new XmlSignService(); // сервис подписания XML
        $attachmentSignService = new AttachmentSignService(); // сервис для подписания вложений
        $client = new CurlSmevService(); // сервис для отправки пакета

        // Данные пользователя и локумента
        $this->userData = User::where('id', $user_id)->first();
        $this->documentData = DocumentType::where('model', $document_type)->first();

        // создание ID сообщения
        $message_id = Uuid::uuid1()->toString();
        $short_identifier = date('Y_m_d_H_i_s') . '-' . uniqid();

        // Создаем директорию для хранения процедуры
        Storage::disk('local')->makeDirectory($this->storagePath. '/' . $message_id);
        $procedureDirPath = Storage::disk('local')->path($this->storagePath. '/' . $message_id);

        if (empty($main_files)) {
            throw new \Exception("Нет файлов для подписи");
        }

        foreach ($main_files as $file_path) {
            if (file_exists($file_path)) {
                copy($file_path, $procedureDirPath. '/' . basename($file_path));
            } else {
                throw new \Exception("Нет файла для подписи: $file_path");
            }

            $attachmentSignService->signAttachment($procedureDirPath . '/' . basename($file_path));

            $this->files[] = [
                    'Document' => $procedureDirPath . '/' . basename($file_path),
                    'Signature' => $procedureDirPath . '/' . basename($file_path) . '.p7s',
                    'Digest' => $attachmentSignService->digestAttachment($procedureDirPath . '/' . basename($file_path)),
                    'DigestSig' => $attachmentSignService->digestAttachment($procedureDirPath . '/' . basename($file_path). '.p7s')
            ];
        }


        $this->createAttachmentFileList();
        $this->loadAttachmentToS3();

        // Создаем файл конверта
        $this->createEnvelopeFile(
            fileNamme: $this->storagePath. '/' . $message_id . '/envelope.xml',
            message_id: $message_id
        );


        $xmlSignService->signXmlFileViaNetwork(
            xmlFilePath: $procedureDirPath . '/envelope.xml',
            outputFilePath: $procedureDirPath . '/envelope_signed.xml'
        );

        $requestData = file_get_contents($procedureDirPath . '/envelope_signed.xml');

        $response = $client->doRequest($requestData, 'urn:SendRequest');
        $response = $client->parseSoapEnvelope($response);

        $rez = GoskeyResultAnalizator::analyzeRequest($response);

        GoskeyRegistry::create([
            'message_id' => $message_id,
            'short_identifier' => $short_identifier,
            'user_id' => $user_id,
            'registryable_id' => $document_id,
            'registryable_type' => $document_type,
            'last_check_at' => null,
            'status' => $rez['error'] ? 'error' : $rez['code'],
            'error_message' => $rez['error'] ? $rez['error_message'] : null,
        ]);


        return $rez;
    }
}

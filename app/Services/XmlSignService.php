<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class XmlSignService
{

    private $address;
    private $elementId;
    private $signatureElementName;

    public function __construct()
    {
        $this->address = config('cryptography.cryptcp_xml_address');
        $this->elementId = 'SIGNED_BY_CALLER';
        $this->signatureElementName = 'ns:CallerInformationSystemSignature';
    }

    public function signXmlFileViaNetwork(string $xmlFilePath = '', string $outputFilePath = '')
    {
        // Проверяем существование файла
        if (!File::exists($xmlFilePath)) {
            throw new \Exception("XML file not found: $xmlFilePath");
        }

        // Читаем содержимое файла
        $fileContent = File::get($xmlFilePath);

        // Формируем запрос
        $response = Http::attach(
            'file', $fileContent, basename($xmlFilePath)
        )->asMultipart()->post($this->address, [
            'elementId' => $this->elementId,
            'signatureElementName' => $this->signatureElementName,
        ]);

        // Проверяем статус ответа
        if ($response->successful()) {
            File::put($outputFilePath, $response->body());
        } else {
            throw new \Exception('Ошибка при подписании XML: ' . $response->body());
        }
    }

    public function signXmlContentViaNetwork(string $xmlContent = ''): string
    {
        // Формируем запрос
        $response = Http::attach(
            'file', $xmlContent, 'request.xml'
        )->asMultipart()->post($this->address, [
            'elementId' => $this->elementId,
            'signatureElementName' => $this->signatureElementName,
        ]);

        // Проверяем статус ответа
        if ($response->successful()) {
            return $response->body();
        } else {
            throw new \Exception('Ошибка при подписании XML: ' . $response->body());
        }
    }

}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class XmlSignService
{

    private string $cryptcpXmlPath;

    public function __construct()
    {
        $this->cryptcpXmlPath = config('cryptography.cryptcp_xml_path');
    }

    private function buildCryptcpXmlCommand(string $xmlFilePath = null, string $outputFilePath = null): string
    {

        $command = 'java -cp "'. $this->cryptcpXmlPath .'target\classes;'. $this->cryptcpXmlPath .'lib\*" smev.sig.Main ';

        if ($xmlFilePath) {
            $command .= ' --file ' . escapeshellarg(str_replace(['/', '\\'], "\\", $xmlFilePath));
        }

        if ($outputFilePath) {
            $command .= ' --out ' . escapeshellarg(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $outputFilePath));
        }

        return $command;
    }

    public function signXmlFileViaNetwork(string $xmlFilePath = '', string $outputFilePath = '')
    {
        $address = config('cryptography.cryptcp_xml_address');

        // Проверяем существование файла
        if (!File::exists($xmlFilePath)) {
            throw new \Exception("XML file not found: $xmlFilePath");
        }

        // Читаем содержимое файла
        $fileContent = File::get($xmlFilePath);

        // Формируем запрос
        $response = Http::attach(
            'file', $fileContent, basename($xmlFilePath)
        )->asMultipart()->post($address, [
            'elementId' => 'SIGNED_BY_CALLER',
            'signatureElementName' => 'ns:CallerInformationSystemSignature',
        ]);

        // Проверяем статус ответа
        if ($response->successful()) {
            File::put($outputFilePath, $response->body());
        } else {
            throw new \Exception('Ошибка при отправке запроса: ' . $response->body());
        }
    }

    public function signXmlFile(string $xmlFilePath = '', string $outputFilePath = ''): bool
    {
        // Формируем команду для подписи XML файла
        $command = $this->buildCryptcpXmlCommand($xmlFilePath, $outputFilePath);

        $output = [];
        $returnCode = 0;
        exec($command, $output, $returnCode);

        // Проверяем код возврата
        if ($returnCode !== 0) {
            // Логируем ошибку
            Log::channel('signature')->error('Ошибка при подписи XML файла: ' . implode("\n", $output));
            return false;
        }

        return true;
    }
}

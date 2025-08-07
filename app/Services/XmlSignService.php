<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

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

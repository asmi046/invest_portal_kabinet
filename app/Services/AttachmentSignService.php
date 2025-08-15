<?php

namespace App\Services;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class AttachmentSignService
{
    public function signAttachment(string $filePath)
    {
        $address = config('cryptography.cryptcp_file_address');

        // Проверяем существование файла
        if (!File::exists($filePath)) {
            throw new \Exception("Файл вложение не найден: $filePath");
        }


        $outputDir = dirname($filePath);
        $fileName = basename($filePath);
        $outputFilePath = $outputDir . '/' . $fileName.".p7s";

        // Читаем содержимое файла
        $fileContent = File::get($filePath);

        // Формируем запрос
        $response = Http::attach(
            'file', $fileContent, basename($filePath)
        )->asMultipart()->post($address);

        // Проверяем статус ответа
        if ($response->successful()) {
            File::put($outputFilePath, $response->body());
        } else {
            throw new \Exception('Ошибка при отправке запроса: ' . $response->body());
        }
    }
}

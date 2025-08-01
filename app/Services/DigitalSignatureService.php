<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Enums\CryptcpErrorCodes;

class DigitalSignatureService
{
    private string $cryptcpPath;
    private string $certificateThumbprint;
    private string $pinCode;
    private string $signatureExtension;
    private array $additionalParams;

    public function __construct()
    {
        $this->cryptcpPath = config('cryptography.cryptcp_path');
        $this->certificateThumbprint = config('cryptography.certificate_thumbprint');
        $this->pinCode = config('cryptography.pin_code');
        $this->signatureExtension = config('cryptography.signature_extension');
        $this->additionalParams = config('cryptography.additional_params');
    }

    /**
     * Подписание строки электронной подписью
     *
     * @param string $data Строка для подписания
     * @return string|null Подписанные данные или null в случае ошибки
     */
    public function signString(string $data): ?string
    {
        try {
            // 1. Генерируем уникальный идентификатор и создаем папку
            $timestamp = time();
            $uniqueId = Str::uuid()->toString();
            $folderName = $timestamp . '_' . $uniqueId;
            $signDirectory = 'sign/' . $folderName;

            // Создаем директорию в storage
            if (!Storage::exists($signDirectory)) {
                Storage::makeDirectory($signDirectory);
            }

            // 2. Записываем переданную строку в файл in.txt
            $inputFileName = 'in.txt';
            $inputFilePath = $signDirectory . '/' . $inputFileName;
            Storage::put($inputFilePath, $data);

            // Получаем полный путь к файлу в файловой системе
            $fullInputFilePath = Storage::path($inputFilePath);

            // 3. Генерируем команду и выполняем её
            $command = $this->buildCryptcpCommand($fullInputFilePath);
            $output = [];
            $returnCode = 0;

            exec($command, $output, $returnCode);
            // dd($output, $returnCode);
            // 4. Передаем результат в метод для интерпретации
            return $this->interpretCommandResult($output, $returnCode, $signDirectory);

        } catch (\Exception $e) {
            // Логируем ошибку в отдельный файл sign.log
            Log::channel('signature')->error('Error in signString: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString(),
                'data_length' => strlen($data),
                'timestamp' => now()->toDateTimeString()
            ]);
            return null;
        }
    }

    /**
     * Формирование команды для вызова cryptcp
     *
     * @param string $inputFile Путь к входному файлу
     * @return string Сформированная команда
     */
    private function buildCryptcpCommand(string $inputFile): string
    {
        $command = sprintf(
            '%s -sign -uMy -thumbprint "%s" -1 -nochain -pin %s -fext %s "%s"',
            $this->cryptcpPath,
            $this->certificateThumbprint,
            $this->pinCode,
            $this->signatureExtension,
            $inputFile
        );

        return $command;
    }

    /**
     * Интерпретация результата выполнения команды cryptcp
     *
     * @param array $output Вывод команды
     * @param int $returnCode Код возврата команды
     * @param string $signDirectory Директория с файлами подписи
     * @return string|null Результат подписания или null в случае ошибки
     */
    private function interpretCommandResult(array $output, int $returnCode, string $signDirectory): ?string
    {
        // Если команда выполнена успешно (код возврата 0)
        if ($returnCode === 0) {
            // Пытаемся найти файл с подписью
            $signatureFileName = 'in.txt' . $this->signatureExtension;
            $signatureFilePath = $signDirectory . '/' .$signatureFileName;

            if (Storage::exists($signatureFilePath)) {
                // Читаем содержимое файла с подписью
                $signatureContent = Storage::get($signatureFilePath);

                // Логируем успешное подписание
                Log::channel('signature')->info('CryptCP command executed successfully', [
                    'directory' => $signDirectory,
                    'signature_size' => strlen($signatureContent),
                    'timestamp' => now()->toDateTimeString()
                ]);

                // Опционально: можно удалить временные файлы
                // Storage::deleteDirectory($signDirectory);

                return $signatureContent;
            }
        }

        // Получаем детальную информацию об ошибке
        $errorDetails = CryptcpErrorCodes::getErrorDetails($returnCode);

        // Логируем ошибку выполнения команды в отдельный файл sign.log
        Log::channel('signature')->error('CryptCP command failed', [
            'return_code' => $returnCode,
            'error_message' => $errorDetails['formatted_message'],
            'error_category' => $errorDetails['category'],
            'is_critical' => $errorDetails['is_critical'],
            'output' => $output,
            'directory' => $signDirectory,
            'command' => $this->buildCryptcpCommand(Storage::path($signDirectory . '/in.txt')),
            'timestamp' => now()->toDateTimeString()
        ]);

        return null;
    }

    /**
     * Получение текстового описания ошибки по коду
     *
     * @param int $errorCode Код ошибки
     * @return string Текстовое описание ошибки
     */
    private function getErrorMessage(int $errorCode): string
    {
        return CryptcpErrorCodes::getErrorMessage($errorCode);
    }
}

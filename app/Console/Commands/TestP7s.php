<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestP7s extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:p7s';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Читает файл .p7s и выводит данные подписи';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $signed_file = storage_path('app/goskey_registry/7938e6dc-89b4-11f0-a9af-00ffbbed2819/2areaget.pdf_subsSign.p7s');
        $signed_data = file_get_contents($signed_file);
        $temporary_output_file = 'temp_output.txt';

        // Проверяем, что файл существует
        if (!file_exists($signed_file)) {
            die("Файл не найден!");
        }

        // Проверяем подпись и извлекаем содержимое
        // Флаг PKCS7_NOVERIFY может быть использован, если не нужна проверка сертификата
        $result = openssl_pkcs7_verify(
            $signed_file,
            PKCS7_NOVERIFY | PKCS7_NOSIGS, // Используем флаги для извлечения данных
            $temporary_output_file
        );

        dd($result);
    }
}

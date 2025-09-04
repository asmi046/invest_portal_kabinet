<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FtpTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ftp:test';

    /**
     * The console command description.
     *
     * @var string
     */
        protected $description = 'Скачивает файл с FTP по URL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $ftpUrl = 'ftp://tAwxlWayyz4cUFB00pkWb3IknEkqQG:OZd06p3McjqgwgsQmIrzmtICgMGd0R@smev3-n0.test.gosuslugi.ru:21/34e4e206-8991-11f0-83ca-00ffbbed2819_subsSign.pkcs7';

            // Парсим URL
            $parts = parse_url($ftpUrl);
            $host = $parts['host'];
            $port = $parts['port'] ?? 21;
            $user = $parts['user'];
            $pass = $parts['pass'];
            $path = $parts['path'];

            $localFile = base_path('downloaded_subsSign.pkcs7');

            // Открываем FTP соединение
            $conn = ftp_connect($host, $port, 30);
            if (!$conn) {
                $this->error('Не удалось подключиться к FTP серверу');
                return 1;
            }

            // Логинимся
            if (!ftp_login($conn, $user, $pass)) {
                $this->error('Не удалось авторизоваться на FTP сервере');
                ftp_close($conn);
                return 1;
            }

            ftp_pasv($conn, true); // Включаем пассивный режим

            // Скачиваем файл
            $result = ftp_get($conn, $localFile, ltrim($path, '/'), FTP_BINARY);

            ftp_close($conn);

            if ($result) {
                $this->info('Файл успешно скачан: ' . $localFile);
            } else {
                $this->error('Ошибка при скачивании файла');
            }
    }
}

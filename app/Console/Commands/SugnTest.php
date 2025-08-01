<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DigitalSignatureService;

class SugnTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sugn:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка работы команды для тестирования подписания документов';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔐 Тестирование сервиса электронной подписи');
        $this->newLine();

        // 1. Запрашиваем строку для подписания
        $stringToSign = $this->ask('Введите строку для подписания');

        if (empty($stringToSign)) {
            $this->error('❌ Строка не может быть пустой!');
            return Command::FAILURE;
        }

        $this->info('📝 Строка для подписания: ' . $stringToSign);
        $this->newLine();

        // 2. Подписываем строку при помощи сервиса
        $this->info('⏳ Выполняется подписание...');

        $signatureService = new DigitalSignatureService();
        $result = $signatureService->signString($stringToSign);

        // 3. Выводим результат на экран
        $this->newLine();

        if ($result !== null) {
            $this->info('✅ Подписание выполнено успешно!');
            $this->newLine();
            $this->line('📄 Результат подписания:');
            $this->line('----------------------------------------');
            $this->line($result);
            $this->line('----------------------------------------');
            $this->newLine();
            $this->info('📊 Размер подписи: ' . strlen($result) . ' байт');

            return Command::SUCCESS;
        } else {
            $this->error('❌ Ошибка при подписании строки!');
            $this->warn('💡 Проверьте:');
            $this->warn('   - Настройки в файле .env (CRYPTCP_*)');
            $this->warn('   - Доступность cryptcp.x64.exe');
            $this->warn('   - Корректность отпечатка сертификата');
            $this->warn('   - Правильность PIN-кода');
            $this->newLine();
            $this->info('📋 Подробности ошибки смотрите в файле: storage/logs/sign.log');

            return Command::FAILURE;
        }
    }
}

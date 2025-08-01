<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoskeyService;

class GoskeyTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'goskey:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Тестирование сервиса Госключ - получение списка методов из WSDL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔑 Тестирование сервиса Госключ');
        $this->newLine();

        try {
            $goskeyService = new GoskeyService();

            // Проверяем доступность сервиса
            $this->info('⏳ Проверка доступности сервиса...');

            if (!$goskeyService->checkServiceAvailability()) {
                $this->error('❌ Сервис Госключ недоступен!');
                $this->warn('💡 Проверьте:');
                $this->warn('   - URL WSDL в настройках (GOSKEY_WSDL_URL)');
                $this->warn('   - Интернет соединение');
                $this->warn('   - Настройки SSL сертификатов');
                return Command::FAILURE;
            }

            $this->info('✅ Сервис доступен!');
            $this->newLine();

            // Получаем список методов
            $this->info('⏳ Получение списка методов из WSDL...');

            $result = $goskeyService->getAvailableMethods();

            $this->info('✅ Список методов успешно получен!');
            $this->newLine();

            // Выводим общую информацию
            $this->info('📊 Общая информация:');
            $this->line('WSDL URL: ' . $result['wsdl_url']);
            $this->line('Всего методов: ' . $result['total_methods']);
            $this->line('Всего типов: ' . count($result['types']));
            $this->line('Время получения: ' . $result['timestamp']);
            $this->newLine();

            // Выводим список методов
            if (!empty($result['methods'])) {
                $this->info('📋 Доступные методы:');
                $this->line('----------------------------------------');

                foreach ($result['methods'] as $index => $method) {
                    $this->line(sprintf('%d. %s', $index + 1, $method['name']));
                    $this->line('   Возвращает: ' . $method['return_type']);

                    if (!empty($method['parameters'])) {
                        $this->line('   Параметры:');
                        foreach ($method['parameters'] as $param) {
                            $this->line(sprintf('     - %s %s', $param['type'], $param['name']));
                        }
                    } else {
                        $this->line('   Параметры: нет');
                    }

                    $this->line('   Сигнатура: ' . $method['signature']);
                    $this->newLine();
                }
            } else {
                $this->warn('⚠️  Методы не найдены в WSDL');
            }

            // Выводим типы данных (только первые 5 для краткости)
            if (!empty($result['types'])) {
                $this->info('🏗️  Типы данных (первые 5):');
                $this->line('----------------------------------------');

                $typesToShow = array_slice($result['types'], 0, 5);
                foreach ($typesToShow as $index => $type) {
                    $this->line(sprintf('%d. %s', $index + 1, $type));
                }

                if (count($result['types']) > 5) {
                    $this->line(sprintf('... и еще %d типов', count($result['types']) - 5));
                }
                $this->newLine();
            }

            // Демонстрация вызова SendRequest
            $this->demonstrateSendRequest($goskeyService);

            $this->info('🎉 Тестирование завершено успешно!');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Ошибка при тестировании сервиса Госключ!');
            $this->newLine();
            $this->error('Сообщение: ' . $e->getMessage());

            if ($e->getPrevious()) {
                $this->error('Детали: ' . $e->getPrevious()->getMessage());
            }

            $this->newLine();
            $this->warn('💡 Возможные причины:');
            $this->warn('   - Неверный URL WSDL');
            $this->warn('   - Сервис временно недоступен');
            $this->warn('   - Проблемы с сетевым соединением');
            $this->warn('   - Ошибки SSL сертификации');
            $this->warn('   - Неверные настройки аутентификации');
            $this->newLine();
            $this->info('📋 Подробности ошибки смотрите в файле: storage/logs/goskey.log');

            return Command::FAILURE;
        }
    }

    /**
     * Демонстрация вызова SendRequest
     */
    private function demonstrateSendRequest($goskeyService)
    {
        $this->newLine();
        $this->info('🚀 Демонстрация вызова SendRequest:');

        try {
            // Способ 1: Использование метода sendRequest
            $requestData = $goskeyService->createSendRequestData(
                'TestRequest',
                [
                    'message' => 'Test message',
                    'user_id' => '12345'
                ],
                [
                    'priority' => 'high',
                    'timeout' => 30
                ]
            );

            $this->line('Подготовленные данные:');
            $this->line(json_encode($requestData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // Закомментировано, чтобы не делать реальный запрос в демо
            $result = $goskeyService->sendRequest($requestData);

            dd($result);

            $this->info('✅ Данные для SendRequest подготовлены успешно!');

            // Способ 2: Универсальный вызов
            $this->newLine();
            $this->line('Альтернативный способ вызова:');
            $this->line('$goskeyService->callSoapMethod("SendRequest", [$requestData]);');

        } catch (\Exception $e) {
            $this->error('❌ Ошибка в демонстрации: ' . $e->getMessage());
        }
    }
}

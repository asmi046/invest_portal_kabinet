<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Services\GoskeyService;
use Illuminate\Console\Command;

class SendRequestTest extends Command
{
    protected $signature = 'goskey:send-request-test';
    protected $description = 'Тестирование метода SendRequest сервиса Госключ';

    public function handle()
    {
        $this->info('🔑 Тестирование SendRequest...');

        try {
            $goskeyService = new GoskeyService();

            $xmlContent = '<RequestSignUkep xmlns="urn://gosuslugi/sig-contract-ukep/1.0.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"   Id="a7c09763-c077-46eb-8fb6-38356f456575"  timestamp="2024-12-24T14:29:10+03:00">
	<OID>1234567890</OID>
	<routeNumber>MNSV03</routeNumber>
	<signExp>2024-12-25T14:28:00+03:00</signExp>
	<descDoc>Договор</descDoc>
	<Contracts>
		<Contract>
			<Document docId="7b3ad8aa-026b-40df-83f2-0b7969083456" uuid="28a2624e-c59e-4d82-89c9-4db9d451bb7f" mimeType="application/pdf" description="Договор"/>
			<Signature docId="7b3ad8aa-026b-40df-83f2-0b7969083456" uuid="70f5753a-1747-4542-a673-e892d1204836" mimeType="application/x-pkcs7-signature" description="Подпись"/>
		</Contract>
	</Contracts>
	<Backlink>https://www.gosuslugi.ru</Backlink>
             <AddData>
                   <AttrName>orgName</AttrName>
                  <AttrValue>Госуслуги</AttrValue>
            </AddData>
</RequestSignUkep>';

$xmlContent = trim(preg_replace('/>\s+</', '><', $xmlContent));

            $testData = [
                'SenderProvidedRequestData' => [
                    'MessageID' => Str::uuid()->toString(),
                    // 'MessagePrimaryContent' => [],
                    'MessagePrimaryContent' => new \SoapVar($xmlContent, XSD_ANYXML),
                    'TestMessage' => true
                ]
            ];

            $this->line('Тестовые данные (массив):');
            $this->line(json_encode($testData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->newLine();

            // Конвертируем массив в объект для SOAP
            $soapData = array_to_object($testData);

            $this->line('Конвертированные данные для SOAP:');
            $this->line(json_encode($soapData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->newLine();

            $result = $goskeyService->sendRequest($testData);

            $this->info('✅ Запрос выполнен успешно!');
            $this->line('Результат:');
            $this->line(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Ошибка: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}

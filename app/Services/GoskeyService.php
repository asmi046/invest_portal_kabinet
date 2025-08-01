<?php

namespace App\Services;

use SoapClient;
use SoapFault;
use Illuminate\Support\Facades\Log;
use Exception;

class GoskeyService
{
    private ?SoapClient $soapClient = null;
    private string $wsdlUrl;
    private array $soapOptions;
    private array $loggingConfig;

    public function __construct()
    {
        $this->wsdlUrl = config('goskey.wsdl_url');
        $this->soapOptions = config('goskey.soap_options', []);
        $this->loggingConfig = config('goskey.logging', []);
    }

    /**
     * Инициализация SOAP клиента
     *
     * @return SoapClient
     * @throws Exception
     */
    private function initSoapClient(): SoapClient
    {
        if ($this->soapClient !== null) {
            return $this->soapClient;
        }

        try {
            // Формируем контекст для SSL и таймаутов
            $context = $this->createStreamContext();

            // Добавляем контекст в опции SOAP
            $soapOptions = array_merge($this->soapOptions, [
                'stream_context' => $context
            ]);

            $this->soapClient = new SoapClient($this->wsdlUrl, $soapOptions);

            $this->logInfo('SOAP client initialized successfully');

            return $this->soapClient;

        } catch (SoapFault $e) {
            $this->logError('Failed to initialize SOAP client: ' . $e->getMessage());
            throw new Exception('Не удалось инициализировать SOAP клиент: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Создание контекста потока с заголовками для SOAP запросов
     *
     * @return resource
     */
    private function createStreamContext()
    {
        $contextOptions = [
            'http' => [
                'header' => [
                    "Content-Type: text/xml;charset=UTF-8",
                    "SOAPAction: \"urn:SendRequest\"",
                    "Host: smev3-d.test.gosuslugi.ru:7500",
                    "Connection: Keep-Alive",
                    "Content-Length: 1234",
                    "User-Agent: Apache-HttpClient/4.5.5 (Java/17.0.12)",
                    "Accept-Encoding: gzip,deflate"
                ]
            ]
        ];

        return stream_context_create($contextOptions);
    }

    /**
     * Получение списка доступных методов из WSDL
     *
     * @return array Список методов с их описанием
     * @throws Exception
     */
    public function getAvailableMethods(): array
    {
        try {
            $client = $this->initSoapClient();

            // Получаем список функций
            $functions = $client->__getFunctions();

            // Получаем список типов
            $types = $client->__getTypes();

            $methods = [];

            // Парсим функции
            foreach ($functions as $function) {
                $parsed = $this->parseFunction($function);
                if ($parsed) {
                    $methods[] = $parsed;
                }
            }

            $result = [
                'methods' => $methods,
                'types' => $types,
                'wsdl_url' => $this->wsdlUrl,
                'total_methods' => count($methods),
                'timestamp' => now()->toDateTimeString()
            ];

            $this->logInfo('Successfully retrieved WSDL methods');

            return $result;

        } catch (SoapFault $e) {
            $this->logError('Failed to get WSDL methods: ' . $e->getMessage());
            throw new Exception('Ошибка при получении методов WSDL: ' . $e->getMessage(), 0, $e);
        } catch (Exception $e) {
            $this->logError('Unexpected error while getting WSDL methods: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Парсинг строки описания функции SOAP
     *
     * @param string $function Строка описания функции
     * @return array|null Распарсенная информация о функции
     */
    private function parseFunction(string $function): ?array
    {
        // Пример входной строки: "string MethodName(string param1, int param2)"
        if (preg_match('/^(\w+)\s+(\w+)\((.*?)\)/', $function, $matches)) {
            $returnType = $matches[1];
            $methodName = $matches[2];
            $parametersString = $matches[3];

            // Парсим параметры
            $parameters = [];
            if (!empty($parametersString)) {
                $paramPairs = explode(',', $parametersString);
                foreach ($paramPairs as $param) {
                    $param = trim($param);
                    if (preg_match('/^(\w+)\s+(\w+)/', $param, $paramMatches)) {
                        $parameters[] = [
                            'type' => $paramMatches[1],
                            'name' => $paramMatches[2]
                        ];
                    }
                }
            }

            return [
                'name' => $methodName,
                'return_type' => $returnType,
                'parameters' => $parameters,
                'signature' => $function
            ];
        }

        return null;
    }

    /**
     * Получение информации о последнем запросе SOAP
     *
     * @return array|null
     */
    public function getLastRequestInfo(): ?array
    {
        if ($this->soapClient === null) {
            return null;
        }

        try {
            return [
                'request_headers' => $this->soapClient->__getLastRequestHeaders(),
                'request_body' => $this->soapClient->__getLastRequest(),
                'response_headers' => $this->soapClient->__getLastResponseHeaders(),
                'response_body' => $this->soapClient->__getLastResponse(),
                'timestamp' => now()->toDateTimeString()
            ];
        } catch (Exception $e) {
            $this->logError('Failed to get last request info: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Проверка доступности WSDL сервиса
     *
     * @return bool
     */
    public function checkServiceAvailability(): bool
    {
        try {
            $this->initSoapClient();
            $this->logInfo('Goskey service is available');
            return true;
        } catch (Exception $e) {
            $this->logError('Goskey service is not available: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Отправка запроса через метод SendRequest
     *
     * @param array $requestData Данные запроса
     * @return array|null Результат выполнения запроса
     * @throws Exception
     */
    public function sendRequest(array $requestData): ?array
    {
        try {
            $client = $this->initSoapClient();

            $response = $client->SendRequest($requestData);

            // Преобразуем ответ в массив если это объект
            if (is_object($response)) {
                $response = json_decode(json_encode($response), true);
            }

            return $response;

        } catch (SoapFault $e) {
            $this->logError('SOAP SendRequest failed: ' . $e->getMessage()." ".$e->faultcode." ".$e->faultstring);
            $this->logError('SOAP failed code: ' .$e->faultcode);
            $this->logError('SOAP failed string: ' .$e->faultstring);
            $this->logError('Last Request: ' . $client->__getLastRequest() );
            $this->logError('Last Response: ' . $client->__getLastResponse() );
            throw new Exception('Ошибка при выполнении SendRequest: ' . $e->getMessage(), 0, $e);
        } catch (Exception $e) {
            $this->logError('Unexpected error in SendRequest: ' . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Создание структуры SendRequestRequest с валидацией
     *
     * @param string $requestType Тип запроса
     * @param array $data Данные запроса
     * @param array $options Дополнительные опции
     * @return array Структурированные данные для SendRequest
     */
    public function createSendRequestData(string $requestType, array $data, array $options = []): array
    {
        $requestData = [
            'RequestType' => $requestType,
            'Data' => $data,
            'Timestamp' => now()->toISOString(),
        ];

        // Добавляем опциональные параметры
        if (!empty($options)) {
            $requestData = array_merge($requestData, $options);
        }

        return $requestData;
    }

    /**
     * Логирование информационных сообщений
     *
     * @param string $message
     */
    private function logInfo(string $message): void
    {
        if ($this->loggingConfig['enabled'] ?? true) {
            Log::channel('goskey')->info('[Goskey Service] ' . $message);
        }
    }

    /**
     * Логирование ошибок
     *
     * @param string $message
     */
    private function logError(string $message): void
    {
        if ($this->loggingConfig['enabled'] ?? true) {
            Log::channel('goskey')->error('[Goskey Service] ' . $message);
        }
    }

    /**
     * Деструктор - очистка ресурсов
     */
    public function __destruct()
    {
        $this->soapClient = null;
    }
}

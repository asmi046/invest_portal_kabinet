<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Госключ Service Settings
    |--------------------------------------------------------------------------
    |
    | Настройки для работы с сервисом Госключ по SOAP протоколу
    |
    */

    /*
    |--------------------------------------------------------------------------
    | WSDL URL
    |--------------------------------------------------------------------------
    |
    | Ссылка на WSDL описание сервиса Госключ
    |
    */
    'wsdl_url' => env('GOSKEY_WSDL_URL', 'https://goskey.ru/service?wsdl'),

    /*
    |--------------------------------------------------------------------------
    | SOAP Client Options
    |--------------------------------------------------------------------------
    |
    | Настройки для SOAP клиента
    |
    */
    'soap_options' => [
        'soap_version' => SOAP_1_1,
        'trace' => true,
        'exceptions' => true,
        'connection_timeout' => env('GOSKEY_CONNECTION_TIMEOUT', 30),
        'encoding' => 'UTF-8',
        'user_agent' => 'Laravel Goskey Client',
    ],

    /*
    |--------------------------------------------------------------------------
    | Timeout Settings
    |--------------------------------------------------------------------------
    |
    | Настройки таймаутов
    |
    */
    'timeout' => [
        'connection' => env('GOSKEY_CONNECTION_TIMEOUT', 30),
        'request' => env('GOSKEY_REQUEST_TIMEOUT', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | SSL Settings
    |--------------------------------------------------------------------------
    |
    | Настройки SSL соединения
    |
    */
    'ssl' => [
        'verify_peer' => env('GOSKEY_SSL_VERIFY_PEER', true),
        'verify_host' => env('GOSKEY_SSL_VERIFY_HOST', true),
        'cafile' => env('GOSKEY_SSL_CAFILE', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Settings
    |--------------------------------------------------------------------------
    |
    | Настройки логирования
    |
    */
    'logging' => [
        'enabled' => env('GOSKEY_LOGGING_ENABLED', true),
        'level' => env('GOSKEY_LOGGING_LEVEL', 'info'),
        'log_requests' => env('GOSKEY_LOG_REQUESTS', true),
        'log_responses' => env('GOSKEY_LOG_RESPONSES', true),
    ],
];

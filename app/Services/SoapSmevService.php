<?php
namespace App\Services;

class SoapSmevService extends \SoapClient
{
    private $customHeaders = [];

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        // Очищаем XML от лишних пробелов для точного Content-Length
        $cleanRequest = trim(preg_replace('/>\s+</', '><', $request));

        // Создаем контекст с кастомными заголовками
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => [
                    "Content-Type: text/xml;charset=UTF-8",
                    "SOAPAction: \"$action\"",
                    "Content-Length: " . strlen($cleanRequest),
                    "Host: smev3-n0.test.gosuslugi.ru:7500",
                    "Connection: Keep-Alive",
                    "User-Agent: Apache-HttpClient/4.5.5 (Java/17.0.12)",
                    "Accept-Encoding: gzip,deflate"
                ],
                'content' => $cleanRequest
            ]
        ]);

        // Выполняем запрос через file_get_contents с кастомным контекстом
        $response = file_get_contents($location, false, $context);

        if ($response === false) {
            throw new SoapFault('HTTP', 'Failed to send SOAP request');
        }

        return $response;
    }
}

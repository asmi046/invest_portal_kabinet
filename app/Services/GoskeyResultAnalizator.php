<?php

namespace App\Services;

class GoskeyResultAnalizator
{
    public static function analyzeRequest($response)
    {
            $result = [];

            // Преобразуем строку в SimpleXMLElement
            try {
                $xml = new \SimpleXMLElement($response);
            } catch (\Exception $e) {
                return ['error' => true, 'error_message' => 'Некорректный XML'];
            }

            // Проверяем наличие узла <soap:Fault>
            $fault = $xml->xpath('//soap:Fault');
            if ($fault && isset($fault[0])) {
                $result['error'] = true;
                // Ищем faultstring
                $faultstring = $fault[0]->xpath('./faultstring');
                if ($faultstring && isset($faultstring[0])) {
                    $result['error_message'] = (string)$faultstring[0];
                }
                // Ищем Code
                $code = $fault[0]->xpath('./Code');
                if ($code && isset($code[0])) {
                    $result['code'] = (string)$code[0];
                }
                return $result;
            }

            $xml->registerXPathNamespace('ns2', 'urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.2');
            $status = $xml->xpath('//ns2:MessageMetadata/ns2:Status');
            if ($status && isset($status[0])) {
                $result['error'] = false;
                $result['code'] = (string)$status[0];
            }

            return $result;
    }
}

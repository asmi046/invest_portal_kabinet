<?php

namespace App\Services;

class GoskeyResultAnalizator
{

    protected static $statuses = [
        "messageIsDelivered" => "Документы доставленны пользователю",
        "requestIsQueued" => "Запрос находится в очереди",
    ];

    public static function analyzeResponse($response)
    {
        $result = [];
        try {
            $xml = new \SimpleXMLElement($response);
        } catch (\Exception $e) {
            return ['error' => true, 'error_message' => 'Некорректный XML'];
        }

        file_put_contents('queue_result.xml', $xml->asXML());

        $xml->registerXPathNamespace('ns2', 'urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.2');
        $originalMessageId = $xml->xpath('//ns2:Response/ns2:OriginalMessageId');
        $messageId = $xml->xpath('//ns2:Response/ns2:MessageMetadata/ns2:MessageId');

        $result['original_message_id'] = isset($originalMessageId[0])?(string)$originalMessageId[0]:null;
        $result['message_id'] = isset($messageId[0])?(string)$messageId[0]:null;

        $smevFaultNodes = $xml->xpath('//ns2:SmevFault');
        if ($smevFaultNodes && isset($smevFaultNodes[0])) {
            $smevFault = $smevFaultNodes[0];
            $result['type']  = 'error';
            $result['error_code']  = (string)$smevFault->Code;
            $result['error_message'] = (string)$smevFault->Description;
        }

        $stateMediumNodes = $xml->xpath("//*[local-name()='StateMedium']");
        if ($stateMediumNodes && isset($stateMediumNodes[0])) {
            $stateMedium = $stateMediumNodes[0];
            $result['type']  = 'status';
            $result['temporary_code'] = (string)$stateMedium->TemporaryCode;
            $result['state_message'] = (string)$stateMedium->StateMessage;
        }

        $status = $xml->xpath('//ns2:MessageMetadata/ns2:Status');
        if ($status && isset($status[0])) {
            $result['type']  = 'status';
            $result['temporary_code'] = -99;
            $result['state_message'] = isset(self::$statuses[(string)$status[0]])?self::$statuses[(string)$status[0]]:(string)$status[0];
        }

        $signCompleat = $xml->xpath("//*[local-name()='ResponseSignUkep']/*[local-name()='Documents']");
        if ($signCompleat) {
            $result['type']  = 'status';
            $result['temporary_code']  = 100;
            $result['state_message'] = "Документы успешно подписанны";
        }

        $errorNodes = $xml->xpath('//*[local-name()="ResponseSignUkep"]/*[local-name()="Error"]');
        if ($errorNodes && isset($errorNodes[0])) {
            $error = $errorNodes[0];
            $result['type']  = 'error';
            $result['error_code']  = (string)$error->ErrorCode;
            $result['error_message'] = (string)$error->ErrorMessage;
        }

        $signRejected = $xml->xpath("//*[local-name()='ResponseSignUkep']/*[local-name()='SignReject']");
        if ($signRejected && isset($signRejected[0])) {
            $result['type']  = 'status';
            $result['temporary_code']  = -100;
            $result['state_message'] = "Пользователь отказался от подписания";
        }




        return $result;
    }

    public static function analyzeAsk($response)
    {
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
        } else {
            $result['error'] = false;
            $result['code'] = 'Success';
        }

        return $result;
    }

    public static function analyzeRequest($response)
    {
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
                $result['code'] = isset(self::$statuses[(string)$status[0]])?self::$statuses[(string)$status[0]]:(string)$status[0];
            }

            return $result;
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

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

            $filesList = self::saveSignedFiles($response);
            if ($filesList) {
                $result['type']  = 'status';
                $result['temporary_code']  = 100;
                $result['state_message'] = "Документы успешно подписанны";
                $result['signatures'] = $filesList;
            } else {
                $result['type']  = 'error';
                $result['error_code']  = -200;
                $result['error_message'] = "Файлы подписи не полученны из хранилища";
            }

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


    /**
     * Скачивает файл с FTP по данным из массива
     * @param array $fileInfo
     * @return bool
     */
    private static function getFilesFromFtp(array $fileInfo, string $originalMessageId)
    {
        $ftpHost = config('goskey.ftp.host');
        $ftpPort = config('goskey.ftp.port', 21);
        $user = $fileInfo['UserName'] ?? '';
        $pass = $fileInfo['Password'] ?? '';
        $remoteFile = ltrim($fileInfo['FileName'] ?? '', '/');

        $localDir = Storage::disk('local')->path("goskey_registry/{$originalMessageId}");
        $localFile = $localDir . '/' . ($fileInfo['description'] ?? 'file') . '_subsSign.p7s';

        // dd($ftpHost, $user, $pass, $remoteFile, $localFile);
        $conn = ftp_connect($ftpHost, $ftpPort, 10);
        if (!$conn) {
            return false;
        }

        if (!ftp_login($conn, $user, $pass)) {
            ftp_close($conn);
            return false;
        }
        ftp_pasv($conn, true);
        $result = ftp_get($conn, $localFile, $remoteFile , FTP_BINARY);
        ftp_close($conn);
        return $result ? true : false;
    }

    public static function saveSignedFiles($response)
    {
        file_put_contents('signed_files.xml', $response);
        $result_list = [];
        try {
            $xml = new \SimpleXMLElement($response);
        } catch (\Exception $e) {
            return ['error' => true, 'error_message' => 'Некорректный XML'];
        }

        $xml->registerXPathNamespace('ns2', 'urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.2');
        $originalMessageIdNodes = $xml->xpath('//ns2:OriginalMessageId');
        $originalMessageId = isset($originalMessageIdNodes[0]) ? (string)$originalMessageIdNodes[0] : null;

        $signCompleat = $xml->xpath("//*[local-name()='ResponseSignUkep']/*[local-name()='Documents']");
        if ($signCompleat && isset($signCompleat[0])) {
            $documents = $signCompleat[0]->children();
            foreach ($documents as $doc) {
                $attributes = [];
                foreach ($doc->SignatureGosKey->attributes() as $attrName => $attrValue) {
                    $attributes[$attrName] = (string)$attrValue;
                }

                $result_list[$attributes['uuid']] = $attributes;
            }
        }

        $xml->registerXPathNamespace('sb2', 'urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.2');
        $attachments = $xml->xpath('//sb2:FSAttachmentsList/sb2:FSAttachment');
        $allFilesLoaded = true;
        $sign_list = [];
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $uuid = (string)$attachment->children('sb2', true)->uuid;
                $result_list[$uuid]['UserName'] = (string)$attachment->children('sb2', true)->UserName;
                $result_list[$uuid]['Password'] = (string)$attachment->children('sb2', true)->Password;
                $result_list[$uuid]['FileName'] = (string)$attachment->children('sb2', true)->FileName;

                $sign_list[] = [
                    'signed_file'=>  'goskey_registry/' .$originalMessageId. '/'. $result_list[$uuid]['description'],
                    'signature'=> 'goskey_registry/' .$originalMessageId. '/'. $result_list[$uuid]['description']. '_subsSign.p7s',
                ];

                $allFilesLoaded = self::getFilesFromFtp($result_list[$uuid], $originalMessageId);
            }
        }

        return $allFilesLoaded ?  $sign_list: null;
    }
}

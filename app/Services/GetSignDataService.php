<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;



class GetSignDataService
{

    private function signStempTemplate(array $signData):string
    {
        $rez = "<table style='color: blue; border-collapse: collapse; font-size:10px; width: 50%;' class ='sign-stemp-table'>";
        $rez .= "<tr><td style='border: 1px solid blue;'>Документ подписан электронной подписью:</td></tr>";

        $rez .= "<tr><td style='border: 1px solid blue;'>" . ($signData['issuerSerial'] ?? '') . "</td></tr>";

        if (isset($signData['subjectDetails'])) {
            $rez .= "<tr><td style='border: 1px solid blue;'>";
            $rez .= ($signData['subjectDetails']['cn']) ? $signData['subjectDetails']['cn'] : '';
            $rez .= isset($signData['subjectDetails']['country']) ? " ".$signData['subjectDetails']['country'] : '';
            $rez .= isset($signData['subjectDetails']['state']) ? " Регион: ".$signData['subjectDetails']['state'] : '';
            $rez .= isset($signData['subjectDetails']['inn']) ? " ИНН: ".$signData['subjectDetails']['inn'] : '';
            $rez .= isset($signData['subjectDetails']['ogrn']) ? " ОГРН: ".$signData['subjectDetails']['ogrn'] : '';
            $rez .= isset($signData['subjectDetails']['organization']) ? " Организация: ".$signData['subjectDetails']['organization'] : '';
            $rez .= "</td></tr>";
        }

        if (isset($signData['issuerDetails'])) {
            $rez .= "<tr><td style='border: 1px solid blue;'>Удостоверяющий центр:</td></tr>";
            $rez .= "<tr><td style='border: 1px solid blue;'>";
            $rez .= $signData['issuerDetails']['cn'] ?? '';
            $rez .= isset($signData['issuerDetails']['country']) ? $signData['issuerDetails']['country'] : '';
            $rez .= isset($signData['issuerDetails']['state']) ? " Регион: ".$signData['issuerDetails']['state'] : '';
            $rez .= isset($signData['issuerDetails']['inn']) ? " ИНН: ".$signData['issuerDetails']['inn'] : '';
            $rez .= isset($signData['issuerDetails']['ogrn']) ? " ОГРН: ".$signData['issuerDetails']['ogrn'] : '';
            $rez .= isset($signData['issuerDetails']['organization']) ? " Организация: ".$signData['issuerDetails']['organization'] : '';
            $rez .= "</td></tr>";

        }
        $rez .= "</table>";

        return $rez;
    }


    public function getSignData(Model $document): array
    {
        $result = $this->getGoskeySignData($document);
        if (!$result['sign_stamped']) {

            $result = $this->getLocalSignData($document);
        }
        return $result;
    }

    public function getLocalSignData(Model $document): array
    {
        $signFiles = $document->signature;

        if (!$signFiles) {
            return ['sign_stamped' => null];
        }

        if (!$signFiles->first()) {
            return ['sign_stamped' => null];
        }

        $signatures_file = $signFiles->signature ?? null;

        $signFileContent = \Storage::get($signFiles->storage_patch.'/'.$signatures_file);


        if (!$signFileContent) {
            return ['sign_stamped' => null];
        }

        $response = Http::attach(
            'file', $signFileContent, 'sign.sig'
        )->asMultipart()->post(config('cryptography.cryptcp_file_get_sign_data_address'));

        // Проверяем статус ответа
        if ($response->successful()) {
            return ['sign_stamped' => $this->signStempTemplate($response->json())];
        } else {
            return ['sign_stamped' => null];
        }
    }



    public function getGoskeySignData(Model $document): array
    {
        $signFiles = $document->goskeyRegistries();
        if (!$signFiles) {
            return ['sign_stamped' => null];
        }

        if (!$signFiles->first()) {
            return ['sign_stamped' => null];
        }

        $signatures = json_decode($signFiles->first()->signatures, true);
        $signatures_file = $signatures[0]["signature"] ?? null;

        $signFileContent = \Storage::get($signatures_file);
        if ($signFileContent === false) {
            return ['sign_stamped' => null];
        }

        $response = Http::attach(
            'file', $signFileContent, 'sign.p7s'
        )->asMultipart()->post(config('cryptography.cryptcp_file_get_sign_data_address'));

        // Проверяем статус ответа
        if ($response->successful()) {
            return ['sign_stamped' => $this->signStempTemplate($response->json())];
        } else {
            return ['sign_stamped' => null];
        }
    }
}

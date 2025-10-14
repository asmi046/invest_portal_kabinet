<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;



class GetSignDataService
{

    private function signStempTemplate(array $signData):string
    {
        $rez = "<table class ='sign-stemp-table'>";
        $rez .= "<tr><td>Документ подписан электронной подписью:</td></tr>";

        $rez .= "<tr><td>" . ($signData['issuerSerial'] ?? '') . "</td></tr>";

        if (isset($signData['subjectDetails'])) {
            $rez .= "<tr><td>";
            $rez .= ($signData['subjectDetails']['cn']) ? $signData['subjectDetails']['cn'] : '';
            $rez .= isset($signData['subjectDetails']['country']) ? " ".$signData['subjectDetails']['country'] : '';
            $rez .= isset($signData['subjectDetails']['state']) ? " Регион: ".$signData['subjectDetails']['state'] : '';
            $rez .= isset($signData['subjectDetails']['inn']) ? " ИНН: ".$signData['subjectDetails']['inn'] : '';
            $rez .= isset($signData['subjectDetails']['ogrn']) ? " ОГРН: ".$signData['subjectDetails']['ogrn'] : '';
            $rez .= isset($signData['subjectDetails']['organization']) ? " Организация: ".$signData['subjectDetails']['organization'] : '';
            $rez .= "</td></tr>";
        }

        if (isset($signData['issuerDetails'])) {
            $rez .= "<tr><td>Удостоверяющий центр:</td></tr>";
            $rez .= "<tr><td>";
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

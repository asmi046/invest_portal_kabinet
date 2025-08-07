<?php
namespace App\Services;

class SmevEnvvelopeService
{
    // $data = [
    //     '@Id' => 'new-id-123',
    //     '@timestamp' => '2025-01-01T10:00:00+03:00',
    //     'OID' => '1111111111',
    //     'routeNumber' => 'MNSV05',
    //     'descDoc' => 'Обновленный договор',
    //     '//Document/@docId' => 'updated-doc-id',
    //     '//Signature/@uuid' => 'updated-signature-uuid'
    // ];

    private function setXmlData($xml = null, $data = [])
    {
        if (empty($data)) {
            return $xml;
        }

        foreach ($data as $path => $value) {
            if (strpos($path, '@') === 0) {
                // Это атрибут корневого элемента
                $attrName = substr($path, 1);
                // dd($attrName);
                $xml[$attrName] = $value;
            } elseif (strpos($path, '//') === 0) {
                // Это XPath
                $nodes = $xml->xpath($path);
                if (!empty($nodes)) {
                    $nodes[0][0] = $value;
                }
            } else {
                // Прямое обращение к узлу
                $xml->{$path} = $value;
            }
        }
    }

    private function setContractsData($part = null, $files = [])
    {
        if (empty($files) || !$part) {
            return $part;
        }

        // Регистрируем namespace для поиска элементов
        $part->registerXPathNamespace('ukep', 'urn://gosuslugi/sig-contract-ukep/1.0.1');

        // Найдем узел Contracts с учетом namespace
        $contractsNodes = $part->xpath('//ukep:Contracts');
        if (empty($contractsNodes)) {
            return $part;
        }

        $contracts = $contractsNodes[0];

        // Очистим существующие Contract элементы
        $existingContracts =  $part->xpath('//ukep:Contracts/ukep:Contract');
        foreach ($existingContracts as $contract) {
            $dom = dom_import_simplexml($contract);
            $dom->parentNode->removeChild($dom);
        }

        // Создаем новый Contract элемент
        $contract = $contracts->addChild('Contract');

        // Обрабатываем каждый файл из массива
        foreach ($files as $fileData) {
            // Добавляем Document
            if (isset($fileData['Document'])) {
                $document = $contract->addChild('Document');

                foreach ($fileData['Document'] as $attrName => $attrValue) {
                    $document->addAttribute($attrName, $attrValue);
                }
            }

            if (isset($fileData['Signature']) && is_array($fileData['Signature'])) {
                $signature = $contract->addChild('Signature');

                foreach ($fileData['Signature'] as $attrName => $attrValue) {
                    $signature->addAttribute($attrName, $attrValue);
                }
            }
        }

        return $part;
    }

    public function createSendRequestEnvelope(string $uuid = null, bool $test = false, array $data = [], array $files = []): string
    {
        $envelop = simplexml_load_file(public_path('smev_envelope_template/SendRequestTemplate.xml'));
        $part = simplexml_load_file(public_path('smev_envelope_template/goskey_parts/ukep.xml'));

        $this->setXmlData($part, $data);
        $this->setContractsData($part, $files);

        $uuid = $uuid ?? \Ramsey\Uuid\Uuid::uuid1()->toString();

        $envelop->xpath('//ns:MessageID')[0][0] = $uuid;
        // $envelop->xpath('//ns:TestMessage')[0][0] = $test ? 'true' : 'false';

        $primaryContentNodes = $envelop->xpath('//ns1:MessagePrimaryContent');

        if (!empty($primaryContentNodes)) {
            $primaryContent = $primaryContentNodes[0];

            $partString = $part->asXML();
            $partString = preg_replace('/<\?xml[^>]*\?>/', '', $partString);

            // Заменяем содержимое узла
            $dom = dom_import_simplexml($primaryContent);
            $fragment = $dom->ownerDocument->createDocumentFragment();
            $fragment->appendXML(trim($partString));

            // Очищаем старое содержимое и добавляем новое
            while ($dom->firstChild) {
                $dom->removeChild($dom->firstChild);
            }
            $dom->appendChild($fragment);
        }

        return html_entity_decode($envelop->asXML(), ENT_QUOTES, 'UTF-8');
    }
}

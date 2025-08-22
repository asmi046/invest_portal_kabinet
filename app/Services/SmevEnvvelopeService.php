<?php
namespace App\Services;

class SmevEnvvelopeService
{

    private array $onAddedAttributes = [ 'fileName', 'localUrl', 'digest' ];

    function updateXmlWithNamespace($xml, $updates) {

        if ($xml === false) {
            return $xml;
        }

        $xml->registerXPathNamespace('s', 'urn://gosuslugi/sig-contract-ukep/1.0.1');

        foreach ($updates as $xpath => $newValue) {
            $nodes = $xml->xpath($xpath);

            if ($nodes !== false && count($nodes) > 0) {
                foreach ($nodes as $node) {
                    $node[0] = $newValue;
                }
            }
        }
    }

    function updateXmlCustomNamespace($xml, $updates) {

        if ($xml === false) {
            return $xml;
        }

        foreach ($updates as $xpath => $newValue) {
            $nodes = $xml->xpath($xpath);

            if ($nodes !== false && count($nodes) > 0) {
                foreach ($nodes as $node) {
                    $node[0] = $newValue;
                }
            }
        }
    }

    public function addRefAttachmentHeaders($xml, array $files = [])
    {
        // Находим узел <ns1:RefAttachmentHeaderList>
        $headerList = $xml->xpath('//ns1:RefAttachmentHeaderList');
        if (!$headerList || !isset($headerList[0])) {
            throw new \Exception('Узел <ns1:RefAttachmentHeaderList> не найден');
        }
        $headerListNode = $headerList[0];

        // Добавляем элементы
        foreach ($files as $item) {
            if (isset($item['Document'])) {
                $header = $headerListNode->addChild('ns1:RefAttachmentHeader', null, $headerListNode->getNamespaces()['ns1'] ?? null);
                $header->addChild('ns1:uuid', $item['Document']['uuid']);
                $header->addChild('ns1:Hash', $item['Document']['digest']);
                $header->addChild('ns1:MimeType', $item['Document']['mimeType']);
            }

            if (isset($item['Signature'])) {
                $header = $headerListNode->addChild('ns1:RefAttachmentHeader', null, $headerListNode->getNamespaces()['ns1'] ?? null);
                $header->addChild('ns1:uuid', $item['Signature']['uuid']);
                $header->addChild('ns1:Hash', $item['Signature']['digest']);
                $header->addChild('ns1:MimeType', $item['Signature']['mimeType']);
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
                    if (!in_array($attrName, $this->onAddedAttributes)) {
                    $document->addAttribute($attrName, $attrValue);
                    }
                }
            }

            if (isset($fileData['Signature']) && is_array($fileData['Signature'])) {
                $signature = $contract->addChild('Signature');

                foreach ($fileData['Signature'] as $attrName => $attrValue) {
                    if (!in_array($attrName, $this->onAddedAttributes)) {
                        $signature->addAttribute($attrName, $attrValue);
                    }
                }
            }
        }

        return $part;
    }

    public function createSendRequestEnvelope(string $uuid = null, bool $test = false, array $data = [], array $files = []): string
    {
        $envelop = simplexml_load_file(public_path('smev_envelope_template/SendRequestTemplate.xml'));
        $part = simplexml_load_file(public_path('smev_envelope_template/goskey_parts/ukep.xml'));


        $this->updateXmlWithNamespace($part, $data);
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

        $this->addRefAttachmentHeaders($envelop, $files);

        return html_entity_decode($envelop->asXML(), ENT_QUOTES, 'UTF-8');
    }

    public function createGetResponseEnvelope(string $namespaceURI = null, string $rootElementLocalName = null): string
    {
        $envelop = simplexml_load_file(public_path('smev_envelope_template/GetResponseTemplate.xml'));

        $headerList = $envelop->xpath('//ns1:MessageTypeSelector');

        if ($namespaceURI) {
            $headerList[0]->addChild('ns1:NamespaceURI', $namespaceURI);
        }
        if ($rootElementLocalName) {
            $headerList[0]->addChild('ns1:RootElementLocalName', $rootElementLocalName);
        }

        // $headerList[0]->addChild('ns1:Timestamp', date('Y-m-d\TH:i:s\Z', strtotime('-15 minutes')));
        $headerList[0]->addChild('ns1:Timestamp', date('Y-m-d\TH:i:s\Z'));

        return html_entity_decode($envelop->asXML(), ENT_QUOTES, 'UTF-8');
    }

    public function createAscRequest(string $messageId = null, bool $accepted = true): string
    {
        $envelop = simplexml_load_file(public_path('smev_envelope_template/AckRequest.xml'));

        $data =[
            '//ns1:AckTargetMessage/@accepted' => $accepted ? 'true' : 'false',
            '//ns1:AckTargetMessage' => $messageId,
        ];

        $this->updateXmlCustomNamespace($envelop, $data);

        return html_entity_decode($envelop->asXML(), ENT_QUOTES, 'UTF-8');

    }
}

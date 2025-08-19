<?php
namespace App\Services;

class CurlSmevService {

    protected $url;
    protected $host;

    public function __construct($url = null)
    {
        $this->url = $url ?? config('goskey.wsdl_url');
        $this->host = parse_url($this->url, PHP_URL_HOST);
    }

    public function doRequest($xmlContent, $action)
    {
        // Очищаем XML от лишних пробелов для точного Content-Length
        $cleanRequest = trim(preg_replace('/>\s+</', '><', $xmlContent));

        // Инициализация cURL
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $cleanRequest);

        // Настройка заголовков
        $setup =  [
            "Content-Type: text/xml;charset=UTF-8",
            "SOAPAction: \"$action\"",
            "Content-Length: " . strlen($cleanRequest),
            "Host: {$this->host}",
            "Connection: Keep-Alive",
            "User-Agent: Apache-HttpClient/4.5.5 (Java/17.0.12)",
            "Accept-Encoding: gzip,deflate"
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $setup);

        // Выполняем запрос
        $response = curl_exec($ch);

        // Проверяем ошибки
        if ($response === false) {
            throw new \Exception('cURL Error: ' . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }

    public function parseSoapEnvelope($mimeMessage, bool $asArray = true) {
        // Извлекаем XML между границами MIME
        if (preg_match('/<soap:Envelope.*<\/soap:Envelope>/s', $mimeMessage, $matches)) {
            $soapContent = $matches[0];

            try {
                $xml = new \SimpleXMLElement($soapContent);

                // Преобразуем весь SOAP Envelope в массив
                if ($asArray) {
                    return $this->xmlToArray($xml);
                } else {
                    return $xml->asXML();
                }

            } catch (\Exception $e) {
                throw new \Exception("Failed to parse SOAP Envelope: " . $e->getMessage());
            }
        }

        throw new \Exception("SOAP envelope not found in MIME message");
    }

    /**
     * Рекурсивно преобразует SimpleXMLElement в массив
     */
    private function xmlToArray(\SimpleXMLElement $xml) {
        $result = [];

        // Получаем все namespace'ы
        $namespaces = $xml->getNamespaces(true);

        // Добавляем атрибуты элемента (без namespace)
        $attributes = $xml->attributes();
        if ($attributes->count() > 0) {
            $result['@attributes'] = [];
            foreach ($attributes as $name => $value) {
                $result['@attributes'][$name] = (string)$value;
            }
        }

        // Добавляем атрибуты с namespace'ами
        foreach ($namespaces as $prefix => $uri) {
            if (empty($prefix)) continue; // Пропускаем пустой namespace

            $nsAttributes = $xml->attributes($uri);
            if ($nsAttributes->count() > 0) {
                if (!isset($result['@attributes'])) {
                    $result['@attributes'] = [];
                }
                foreach ($nsAttributes as $name => $value) {
                    $attrName = "{$prefix}:{$name}";
                    $result['@attributes'][$attrName] = (string)$value;
                }
            }
        }

        // Собираем все дочерние элементы (с namespace и без)
        $allChildren = [];

        // Сначала элементы без namespace
        $children = $xml->children();
        foreach ($children as $name => $child) {
            $allChildren[$name] = $child;
        }

        // Затем элементы с namespace
        foreach ($namespaces as $prefix => $uri) {
            if (empty($prefix)) continue; // Пропускаем пустой namespace

            $nsChildren = $xml->children($uri);
            foreach ($nsChildren as $name => $child) {
                $elementName = "{$prefix}:{$name}";
                $allChildren[$elementName] = $child;
            }
        }

        // Обрабатываем все собранные дочерние элементы
        foreach ($allChildren as $name => $child) {
            $childArray = $this->xmlToArray($child);

            // Если элемент уже существует, делаем массив
            if (isset($result[$name])) {
                if (!is_array($result[$name]) || !isset($result[$name][0])) {
                    $result[$name] = [$result[$name]];
                }
                $result[$name][] = $childArray;
            } else {
                $result[$name] = $childArray;
            }
        }

        // Если нет дочерних элементов, возвращаем текстовое содержимое
        if (empty($result) || (count($result) == 1 && isset($result['@attributes']))) {
            $text = trim((string)$xml);
            if ($text !== '') {
                if (isset($result['@attributes'])) {
                    $result['@value'] = $text;
                } else {
                    return $text;
                }
            }
        }

        return $result;
    }
}

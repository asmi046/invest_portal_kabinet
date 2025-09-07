<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ValidateXmlByXsd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:validate-xsd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Валидирует XML-файл по XSD-схеме';

    /**
     * Путь к XML и XSD (константы)
     */
    // const XML_PATH = 'storage/app/goskey_registry/6c6b5e3c-8c1e-11f0-9069-00ffbbed2819/envelope_signed.xml';
    const XML_PATH = 'public/test_xml/pak_ul.xml';
    const XSD_PATH = 'public/schemas/schemas.xsd'; // Укажите путь к вашей XSD-схеме

    public function handle()
    {
        $xmlPath = base_path(self::XML_PATH);
        $xsdPath = base_path(self::XSD_PATH);

        if (!file_exists($xmlPath)) {
            $this->error('XML файл не найден: ' . $xmlPath);
            return 1;
        }
        if (!file_exists($xsdPath)) {
            $this->error('XSD схема не найдена: ' . $xsdPath);
            return 1;
        }

        libxml_use_internal_errors(true);
        $xml = new \DOMDocument();
        $xml->load($xmlPath);

        if ($xml->schemaValidate($xsdPath)) {
            $this->info('XML валиден по XSD!');
        } else {
            $this->error('XML невалиден по XSD!');
            foreach (libxml_get_errors() as $error) {
                $this->line($error->message);
            }
        }
        libxml_clear_errors();
    }
}

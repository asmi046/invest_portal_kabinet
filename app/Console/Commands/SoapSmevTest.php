<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CurlSmevService;
use App\Services\SoapSmevService;
use App\Services\SmevEnvvelopeService;

class SoapSmevTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:soap-smev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $url = "http://smev3-n0.test.gosuslugi.ru:7500/smev/v1.2/ws?wsdl";
        $client = new CurlSmevService($url);

        $requestData = file_get_contents(public_path('test_xml/rez.xml'));

        $element = new SmevEnvvelopeService();

        $uuid = \Ramsey\Uuid\Uuid::uuid1()->toString();

        $element->createSendRequestEnvelope(uuid: $uuid, test: true,
        data: [
            '@Id' => \Ramsey\Uuid\Uuid::uuid1()->toString(),
            '@timestamp' => date('Y-m-d\TH:i:s+03:00'),
            'OID' => '1234567890',
            'descDoc' => 'Договор',
            'Backlink' => config('goskey.backlink'),
            '//AttrValue' => 'Инвестиционный портал Курской Области',
        ],

        files: [
           [
                'Document' => [
                    'uuid' => '28a2624e-c59e-4d82-89c9-4db9d451bb7f',
                    'docId' => '7b3ad8aa-026b-40df-83f2-0b7969083456',
                    'mimeType' => 'application/pdf',
                    'description' => 'Договор'
                ],

                'Signature' => [

                        'docId' => '7b3ad8aa-026b-40df-83f2-0b7969083456',
                        'uuid' => '70f5753a-1747-4542-a673-e892d1204836',
                        'mimeType' => 'application/x-pkcs7-signature',
                        'description' => 'Подпись'

                ]
            ],

            // [
            //     'Document' => [
            //         'docId' => '7b3ad81a-026b-40df-83f2-0b7969083456',
            //         'uuid' => \Ramsey\Uuid\Uuid::uuid1()->toString(),
            //         'mimeType' => 'application/pdf',
            //         'description' => 'Договор'
            //     ],

            //     'Signature' => [
            //             'docId' => '7b3ad81a-026b-40df-83f2-0b7969083456',
            //             'uuid' => \Ramsey\Uuid\Uuid::uuid1()->toString(),
            //             'mimeType' => 'application/x-pkcs7-signature',
            //             'description' => 'Подпись'
            //     ]
            // ],


        ]);

        $response = $client->doRequest($requestData, 'urn:SendRequest');
        $rez = $client->parseSoapEnvelope($response);


        $this->info(print_r($rez, true));
    }
}

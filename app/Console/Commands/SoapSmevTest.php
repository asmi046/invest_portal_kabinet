<?php

namespace App\Console\Commands;

use App\Models\AreaGet;
use Illuminate\Console\Command;
use App\Services\XmlSignService;
use App\Services\SmevEnvvelopeService;
use App\Services\GoskeyRegistryService;
use App\Services\GoskeyResultAnalizator;

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

        $goskeyRegistryService = new GoskeyRegistryService();
        $rez = $goskeyRegistryService->createProcedure(
            main_files: [
                public_path('signed_docs\\2areaget.pdf'),
                public_path('signed_docs\\5-area-get.pdf')
            ],
            document_type: AreaGet::class,
            document_id: 1,
            user_id: 5,
            ul: true
        );
        dd($rez);
    }
}

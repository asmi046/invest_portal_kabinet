<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoskeyResultAnalizator;

class FileGetInXmlTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:file-get-in-xml-test';

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
        $xmlStr = file_get_contents('signed_files.xml');
        $rez = GoskeyResultAnalizator::saveSignedFiles($xmlStr);
        dd($rez);
    }
}

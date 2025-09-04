<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:s3';

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
        // $directory = $this->ask('Введите имя директории для поиска файлов в S3');
        try {
            // $content = Storage::disk('s3')->get('6613e6cd-d6a3-4e05-a925-1ba155c81d8e/34e4e206-8991-11f0-83ca-00ffbbed2819_subsSign.pkcs7');
            $content = Storage::disk('s3')->download('6613e6cd-d6a3-4e05-a925-1ba155c81d8e/34e4e206-8991-11f0-83ca-00ffbbed2819_subsSign.pkcs7', 'local_subsSign.pkcs7');
            $this->info('Содержимое файла:');
            dd($content);

        } catch (\Exception $e) {
            $this->error('Ошибка S3: ' . $e->getMessage());
        }
    }
}

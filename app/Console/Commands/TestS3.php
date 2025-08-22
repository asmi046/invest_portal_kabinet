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
            $directory = '81172f94-7910-11f0-99df-00ffbbed2819/file.txt';
            Storage::disk('s3')->put($directory, 'Hello, S3!');
            $this->info('Файл успешно записан!');

            $content = Storage::disk('s3')->allFiles($directory);
            $this->info('Содержимое директории:');
            $this->line(implode("\n", $content));

        } catch (\Exception $e) {
            $this->error('Ошибка S3: ' . $e->getMessage());
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу перед заполнением
        DB::table('document_types')->truncate();

        // Данные для заполнения таблицы document_types
        $documentTypes = [
            [
                'name' => 'Заявление на выделение земельного участка',
                'model' => 'App\Models\AreaGet',
                'description' => 'Заявление на выделение земельного участка для инвестиционных целей',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Заявление на финансирование инвестиционного проекта',
                'model' => 'App\Models\Project',
                'description' => 'Заявление на получение финансирования для реализации инвестиционного проекта',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Заявление на технологическое присоединение к электрическим сетям',
                'model' => 'App\Models\TechnicalConnects',
                'description' => 'Заявление на технологическое присоединение объектов к электрическим сетям',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Заявление на государственную поддержку',
                'model' => 'App\Models\Support',
                'description' => 'Заявление на получение государственной поддержки инвестиционной деятельности',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Вставляем данные в таблицу напрямую через DB фасад
        DB::table('document_types')->insert($documentTypes);

        // Выводим информацию о количестве добавленных записей
        $this->command->info('Document types seeded: ' . count($documentTypes) . ' records');
    }
}

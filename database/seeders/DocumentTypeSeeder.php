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

        // Данные для заполнения таблицы document_types
        $documentTypes = [
            [
                'name' => 'Заявление на выделение земельного участка',
                'short_name' => 'Заявление на выделение земельного участка',
                'model' => 'App\Models\AreaGet',
                'order' => 100,
                'create_url' => "/area_get/create",
                'index_url' => "/area_get",
                'description' => 'Заявление на выделение земельного участка для инвестиционных целей',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "building-icon",
            ],
            [
                'name' => 'Заявление на финансирование инвестиционного проекта',
                'short_name' => 'Заявление на финансирование инвестиционного проекта',
                'model' => 'App\Models\Project',
                'description' => 'Заявление на получение финансирования для реализации инвестиционного проекта',
                'order' => 100,
                'create_url' => "/projects/create",
                'index_url' => "/projects",
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "laptop-icon",
            ],
            [
                'name' => 'Заявление на технологическое присоединение к электрическим сетям',
                'short_name' => 'Заявление на технологическое присоединение к электрическим сетям',
                'model' => 'App\Models\TechnicalConnects',
                'description' => 'Заявление на технологическое присоединение объектов к электрическим сетям',
                'order' => 100,
                'create_url' => "/support/create",
                'index_url' => "/support",
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],
            [
                'name' => 'Заявление на государственную поддержку',
                'short_name' => 'Заявление на государственную поддержку',
                'model' => 'App\Models\Support',
                'order' => 100,
                'create_url' => "/technical_connect/create",
                'index_url' => "/technical_connect",
                'description' => 'Заявление на получение государственной поддержки инвестиционной деятельности',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => '	Заявление на приобретение земельного участка, находящегося в государственной собственности, в аренду без проведения торгов',
                'short_name' => 'Заявление на приобретение земельного участка в аренду',
                'model' => 'App\Models\LandLeaseApplication',
                'order' => 100,
                'create_url' => "/lend_lease/create",
                'index_url' => "/lend_lease",
                'description' => 'Заявление на аренду земельного участка в государственной собственности без торгов',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => '	Заявление о проведении аукциона по продаже земельного участка, находящегося в государственной собственности',
                'short_name' => 'Заявление о проведении аукциона по продаже земельного участка',
                'model' => 'App\Models\LandAuctionApplication',
                'order' => 100,
                'create_url' => "/lend_auction/create",
                'index_url' => "/lend_auction",
                'description' => 'Заявление о проведении аукциона по продаже земельного участка, находящегося в государственной собственности',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => '	Получить разрешение на строительство в рамках реализации инвестиционного проекта',
                'short_name' => 'Получить разрешение на строительство',
                'model' => 'App\Models\ConstructionPermit',
                'order' => 100,
                'create_url' => "/construction_permit/create",
                'index_url' => "/construction_permit",
                'description' => 'Заявление на получение разрешения на строительство в рамках реализации инвестиционного проекта',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => 'Заявление на техническое присоединение к объектам газораспределения',
                'short_name' => 'Заявление на техническое присоединение к объектам газораспределения',
                'model' => 'App\Models\GasConnection',
                'order' => 100,
                'create_url' => "/gas_connection/create",
                'index_url' => "/gas_connection",
                'description' => 'Заявление на техническое присоединение к объектам газораспределения',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => 'Заявление на техническое присоединение к объектам теплоснабжения',
                'short_name' => 'Заявление на техническое присоединение к объектам теплоснабжения',
                'model' => 'App\Models\HeatConnection',
                'order' => 100,
                'create_url' => "/heat_connection/create",
                'index_url' => "/heat_connection",
                'description' => 'Заявление на техническое присоединение к объектам теплоснабжения',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => 'Заявление на техническое присоединение к объектам водоснабжения и водоотведения',
                'short_name' => 'Заявление на техническое присоединение к объектам водоснабжения и водоотведения',
                'model' => 'App\Models\WaterConnection',
                'order' => 100,
                'create_url' => "/water_connection/create",
                'index_url' => "/water_connection",
                'description' => 'Заявление на техническое присоединение к объектам водоснабжения и водоотведения',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],

            [
                'name' => 'Заявление о выдаче разрешения на ввод объекта в эксплуатацию',
                'short_name' => 'Заявление о выдаче разрешения на ввод объекта в эксплуатацию',
                'model' => 'App\Models\CommissioningPermit',
                'order' => 100,
                'create_url' => "/commissioning_permit/create",
                'index_url' => "/commissioning_permit",
                'description' => 'Заявление о выдаче разрешения на ввод объекта в эксплуатацию',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => "tablet-icon",
            ],
        ];

        // Вставляем данные в таблицу напрямую через DB фасад
        DB::table('document_types')->insert($documentTypes);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('stages')->insert([
            [
                'name' => 'Черновик',
                'order' => 1,
                'document_type_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отправлено на рассмотрение',
                'order' => 2,
                'document_type_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'На проверке',
                'order' => 3,
                'document_type_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Возврат на доработку',
                'order' => 4,
                'document_type_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Принят',
                'order' => 5,
                'document_type_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Выводим информацию о количестве добавленных записей
        $this->command->info('Document types seeded: ' . count($documentTypes) . ' records');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class TechnicalConnectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $state = [
            "Черновик",
            "Отправлен",
            "В обработке",
            "Предоставлен ответ"
        ];

        DB::table("technical_connects")->insert(
            [
                [
                    'user_id' => 1,
                    'state'=> "Черновик",
                    "name" => "Иванов Иван Иванович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 900 000 00 00",
                    "organization" => "Тестовая организация 1",
                    "egrul" => "770300584079",
                    "adress" => "г. Курск, ул. Орловская д. 5",

                    "project_name" => "Тестовый проект 0",
                    "cadastr_number" => "31:16:0123029:163",
                    "geo" => "51.730846, 36.193015",
                    "object_place_name" => "город Крачев д. 15",

                    "safety_category" => "Третья",
                    "point_count" => 1,

                    "osnovanie" => "увеличение максимальной мощности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Орловская д. 7",

                    "pover_prin_devices" => "500",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "500",
                    "napr_pris_devices" => "220",
                    "pover_pris_r_devices"=>"",
                    "napr_pris_r_devices"=>"",

                ],
                [
                    'user_id' => 1,
                    'state'=> "Черновик",
                    "name" => "Петров Петр Петрович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 901 000 11 22",
                    "organization" => "Тестовая организация 2",
                    "egrul" => "880300584079",
                    "adress" => "г. Курск, ул. Казацкая д. 5",

                    "project_name" => "Тестовый проект 1",
                    "cadastr_number" => "31:16:0123029:163",
                    "geo" => "51.730846, 36.193015",
                    "object_place_name" => "Село Червоное д. 10",

                    "safety_category" => "Третья",
                    "point_count" => 1,

                    "osnovanie" => "увеличение максимальной мощности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",

                ],
                [
                    'user_id' => 2,
                    'state'=> "Черновик",
                    "name" => "Клименьтев Петр Петрович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 901 000 11 22",
                    "organization" => "Тестовая организация 2",
                    "egrul" => "880300584079",
                    "adress" => "г. Курск, ул. Казацкая д. 5",


                    "project_name" => "Тестовый проект 2",
                    "cadastr_number" => "31:16:0123029:163",
                    "geo" => "51.730846, 36.193015",
                    "object_place_name" => "Село Верхние лихоборы д. 13",

                    "safety_category" => "Третья",
                    "point_count" => 2,

                    "osnovanie" => "увеличение максимальной мощности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",


                ],

                [
                    'user_id' => 2,
                    'state'=> "Черновик",
                    "name" => "Клименьтев Иван Петрович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 901 000 11 22",
                    "organization" => "Тестовая организация 2",
                    "egrul" => "880300584079",
                    "adress" => "г. Курск, ул. Казацкая д. 5",

                    "project_name" => "Тестовый проект 3",
                    "cadastr_number" => "31:16:0123029:163",
                    "geo" => "51.730846, 36.193015",
                    "object_place_name" => "город Павловск д. 1",

                    "safety_category" => "Третья",
                    "point_count" => 1,

                    "osnovanie" => "увеличение максимальной мощности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",


                ],
            ]

        );
    }
}

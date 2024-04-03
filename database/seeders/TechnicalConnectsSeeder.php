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

                    "pasport_seria" => "3804",
                    "pasport_number" => "000000",
                    "pasport_vidan"=> "ОМ №5 УВД г. КУРСКА",

                    "osnovanie" => "увеличение максимальной мощьности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Орловская д. 7",

                    "pover_prin_devices" => "500",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "500",
                    "napr_pris_devices" => "220",
                    "pover_pris_r_devices"=>"",
                    "napr_pris_r_devices"=>"",
                    "rashet_plati"=>"Вариант 1",
                    "gen_postavhik" => "КурскЭнерго",
                    "prilogenie" => "",
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

                    "pasport_seria" => "3805",
                    "pasport_number" => "111000",
                    "pasport_vidan"=> "ОМ №7 УВД г. КУРСКА",

                    "osnovanie" => "увеличение максимальной мощьности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",
                    "rashet_plati"=>"Вариант 2",
                    "gen_postavhik" => "Россети",
                    "prilogenie" => "",
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

                    "pasport_seria" => "3805",
                    "pasport_number" => "111000",
                    "pasport_vidan"=> "ОМ №7 УВД г. КУРСКА",

                    "osnovanie" => "увеличение максимальной мощьности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",
                    "rashet_plati"=>"Вариант 2",
                    "gen_postavhik" => "Россети",
                    "prilogenie" => "",
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

                    "pasport_seria" => "3805",
                    "pasport_number" => "111000",
                    "pasport_vidan"=> "ОМ №7 УВД г. КУРСКА",

                    "osnovanie" => "увеличение максимальной мощьности",
                    "ustroistvo" => "Трансформатор",
                    "raspologeie" => "г. Курск, ул. Гайдара д. 7",

                    "pover_prin_devices" => "800",
                    "napr_prin_devices" => "220",
                    "pover_pris_devices" => "800",
                    "napr_pris_devices" => "820",
                    "pover_pris_r_devices"=>"500",
                    "napr_pris_r_devices"=>"220",
                    "rashet_plati"=>"Вариант 2",
                    "gen_postavhik" => "Россети",
                    "prilogenie" => "",
                ],
            ]

        );
    }
}

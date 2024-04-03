<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;


class AreaGetSeeder extends Seeder
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

        DB::table("area_gets")->insert(
            [
                [
                    'user_id' => 1,
                    'state'=> "Черновик",
                    "name" => "Иванов Иван Иванович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 900 000 00 00",
                    "organization" => "Тестовая организация 1",
                    "object_name" => "Парк",
                    "object_type" => "Масштабный инвестиционный проект",
                    "prilogenie_list_count" => rand(3, 7)
                ],
                [
                    'user_id' => 1,
                    'state'=> "Черновик",
                    "name" => "Петров Иван Федорович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 900 000 00 00",
                    "organization" => "Тестовая организация 1",
                    "object_name" => "Парк",
                    "object_type" => "Коммунально-бытового назначения",
                    "prilogenie_list_count" => rand(3, 7)
                ],
                [
                    'user_id' => 2,
                    'state'=> "Черновик",
                    "name" => "Климов Иван Иванович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 900 000 00 00",
                    "organization" => "Тестовая организация 1",
                    "object_name" => "Парк",
                    "object_type" => "Коммунально-бытового назначения",
                    "prilogenie_list_count" => rand(3, 7)
                ],
                [
                    'user_id' => 2,
                    'state'=> "Черновик",
                    "name" => "Краков Иван Степанович",
                    "dolgnost" => "ИП",
                    "phone" => "+7 900 000 00 00",
                    "organization" => "Тестовая организация 1",
                    "object_name" => "Клумба",
                    "object_type" => "Коммунально-бытового назначения",
                    "prilogenie_list_count" => rand(3, 7)
                ],
            ]
        );
    }
}

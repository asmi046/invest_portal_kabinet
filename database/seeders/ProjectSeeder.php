<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = [
            "Черновик",
            "В обработке",
            "Предоставлен ответ"
        ];

        for ($i=0; $i<300; $i++){
            DB::table("projects")->insertGetId(
                [
                    'user_id' => rand(1,3),
                    'state'=> $state[rand(0,2)],
                    'name' => "Тестовый проект ".$i,
                    'target' => "Сделать лучьше",
                    'time_relis'=> rand(1,5),
                    'worck_place_coun'=> rand(3,100),
                    'relis_area'=>"Курская область",
                    'invest_volume'=>rand(1,15),
                    'project_description'=>"Очень хороший проект",
                    'erth_area_description'=>"Нужно 3 Га",
                    'prom_area_description'=>"Нет не надо",
                    'dop_volume'=>rand(1,15),
                    'electro'=>rand(1,15),
                    'gaz'=>rand(1,15),
                    'gos_support'=>rand(0,1),
                    'gos_support_direction'=>"Кредить",
                    'description'=> "Самый лучший проект на свете"
                ]
            );
        }



    }
}

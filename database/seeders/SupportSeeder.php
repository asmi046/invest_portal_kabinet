<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class SupportSeeder extends Seeder
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

        $names = [
            "Льготы по налогу на имущество",
            "Льготы по налогу на прибыль",
            "Льготы по налогу на транспорт",
            "Льготы по налогу на землю",
            "Предоставление земельных участков без торгов",
            "Субсидии инвесторам"
        ];

        for ($i=0; $i<300; $i++){
            DB::table("supports")->insertGetId(
                [
                    'user_id' => rand(1,3),
                    'state'=> $state[rand(0,2)],
                    'organization' => "Тестовая организация ".$i,
                    'name' => $names[rand(0,5)],
                    'invest_volume'=>rand(1,15),
                    'detail' => "Развитие вперед",
                    'many_src' => "Кредит",
                    'time_relis'=> rand(1,5),
                    'npv'=>rand(1,5),
                    'irr'=>rand(1,5),
                    'time_prib'=>rand(15, 150),
                    'worck_place_coun'=>rand(5, 45),
                    'zp'=>rand(15000, 300000),
                    'okved'=> "1111-11, 2232-34",
                    'description'=>"Нужна поддержка",
                ]
            );
        }
    }
}

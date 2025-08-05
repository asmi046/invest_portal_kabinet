<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->insert([
            'name' => 'Контролирующая организация (ЦЭВ)',
            'short_name' => 'Администрация',
        ]);

        DB::table('organizations')->insert([
            'name' => 'Министерство экономики Курской Области',
            'short_name' => 'Минэкономики',
        ]);

        DB::table('organizations')->insert([
            'name' => 'Электрические сети Курской области',
            'short_name' => 'Электросети',
        ]);

    }
}

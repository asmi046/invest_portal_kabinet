<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class OrganizationContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_doc = [
            [
                'person' => "Агафонов Владимир Александрович",
                'dolgnost' => "генеральный директор",
                'organization' => "ООО «Газпром межрегионгаз Курск» АО «Газпром газораспределение Курск»",
                'phone' => "+7 (4712) 73-52-00",
            ],

            [
                'person' => "Демидов Сергей Николаевич",
                'dolgnost' => "заместитель генерального директора – директор филиала",
                'organization' => "АО «Россети Центр»- «Курскэнерго»",
                'phone' => "+7 (4712) 55-73-59",
            ],

            [
                'person' => "Машошин Олег Леонидович",
                'dolgnost' => "директор",
                'organization' => "МУП «Курскводоканал»",
                'phone' => "+7 (4712) 70-13-19",
            ],

            [
                'person' => "Болдырев Олег Игоревич",
                'dolgnost' => "генеральный директор",
                'organization' => "АО «Курскоблводоканал»",
                'phone' => "+7 (4712) 22-33-30",
            ],

            [
                'person' => "Гладких Михаил Васильевич",
                'dolgnost' => "директор",
                'organization' => "МУП «Горводоканал» муниципального образования «город Железногорск»",
                'phone' => "+7 (47148) 2-50-65",
            ],
        ];

        foreach ($data_doc as $item) {
            DB::table("organization_contacts")->insert(
                $item
            );
        }
    }
}

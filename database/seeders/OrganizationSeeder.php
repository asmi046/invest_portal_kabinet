<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::create([
            'name' => 'Контролирующая организация',
            'short_name' => 'Администрация',
        ]);

        // $organization->documentTypes()->create([
        //     [
        //         'documentable_type' => 'App\Models\AreaGet',
        //         'documentable_id' => 1
        //     ],
        //     [
        //         'documentable_type' => 'App\Models\Project',
        //         'documentable_id' => 1
        //     ],
        //     [
        //         'documentable_type' => 'App\Models\Support',
        //         'documentable_id' => 1
        //     ],
        //     [
        //         'documentable_type' => 'App\Models\TechnicalConnects',
        //         'documentable_id' => 1
        //     ]

        // ]);
        // $organization->documentTypes()->create(
        //     [
        //         'documentable_type' => 'App\Models\AreaGet',
        //         'documentable_id' => 1
        //     ]
        //     );

        $organization = Organization::create([
            'name' => 'Министерство экономики Курской Области',
            'short_name' => 'Минэкономики',
        ]);

        // $organization->documentTypes()->create([
        //     [
        //         'documentable_type' => 'App\Models\Project',
        //         'documentable_id' => 1
        //     ],
        //     [
        //         'documentable_type' => 'App\Models\Support',
        //         'documentable_id' => 1
        //     ],
        // ]);
    }
}

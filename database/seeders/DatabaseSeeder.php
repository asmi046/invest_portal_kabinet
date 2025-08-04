<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            OrganizationSeeder::class,
            UserSeeder::class,
            InvestDocumentSeeder::class,
            AlgorithmSeeder::class,
            ProjectSeeder::class,
            SupportSeeder::class,
            TechnicalConnectsSeeder::class,
            AreaGetSeeder::class,
            OrganizationContactSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

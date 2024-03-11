<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userID = DB::table("users")->insertGetId(
            [
                    'name' => "Супер Админ",
                    'phone' => "+7 (903) 633 08 01",
                    'email' => "asmi046_1@gmail.com",
                    'password' => Hash::make("123"),
                    'email_verified_at' => date("Y-m-d H:i:s")
            ]
        );

        $userID = DB::table("users")->insertGetId(
            [
                    'name' => "Иванов Иван",
                    'phone' => "+7 (904) 634 02 01",
                    'email' => "guest1@email.ru",
                    'password' => Hash::make("123"),
                    'email_verified_at' => date("Y-m-d H:i:s"),
            ]
        );


        $userID = DB::table("users")->insertGetId(
            [
                    'name' => "Сидоров Иван",
                    'phone' => "+7 (908) 624 04 22",
                    'email' => "gues2@email.ru",
                    'password' => Hash::make("123"),
                    'email_verified_at' => date("Y-m-d H:i:s"),
            ]
        );

        $userID = DB::table("moonshine_users")->insertGetId(
            [
                    'name' => "Админ",
                    'email' => "asmi046@gmail.com",
                    'password' => Hash::make("123"),
                    'moonshine_user_role_id' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
            ]
        );

    }
}

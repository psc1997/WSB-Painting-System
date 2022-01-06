<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin + User
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@localhost.local',
                'password' => Hash::make('qwerty123'),
                'created_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'user@localhost.local',
                'password' => Hash::make('qwerty123'),
                'created_at' => now(),
            ]
        ]);

        // Other Users
        DB::table('users')->insert([
            [
                'name' => 'rafal.kozlowski',
                'email' => 'RafalKozlowski@localhost.local',
                'password' => Hash::make('Johgh4aif'),
                'created_at' => now(),
            ],[
                'name' => 'gertruda.adamczyk',
                'email' => 'GertrudaAdamczyk@localhost.local',
                'password' => Hash::make('qwerty123'),
                'created_at' => now(),
            ],[
                'name' => 'zosia.nowicka',
                'email' => 'ZosiaNowicka@localhost.local',
                'password' => Hash::make('qwerty123'),
                'created_at' => now(),
            ]
        ]);
    }
}

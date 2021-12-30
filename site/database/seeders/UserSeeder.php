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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@localhost.local',
            'password' => Hash::make('qwerty123'),
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@localhost.local',
            'password' => Hash::make('qwerty123'),
        ]);
    }
}

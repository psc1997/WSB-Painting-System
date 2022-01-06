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
                'first_name' => 'Rafał',
                'last_name' => 'Kozłowski',
                'description' => 'Oat cake jujubes chocolate jujubes jujubes sugar plum cookie. Sugar plum topping cake donut ice cream tiramisu powder candy. Sugar plum gummi bears candy croissant jelly sugar plum. Cotton candy macaroon candy sugar plum croissant apple pie pudding lollipop.',
                'created_at' => now(),
            ],[
                'name' => 'gertruda.adamczyk',
                'email' => 'GertrudaAdamczyk@localhost.local',
                'password' => Hash::make('qwerty123'),
                'first_name' => 'Gertruda',
                'last_name' => 'Adamczyk',
                'description' => 'Cupcake powder croissant tart gingerbread icing dragée chocolate cake pastry. Sesame snaps sugar plum biscuit tootsie roll topping marshmallow pie cookie. Sugar plum marshmallow jelly marzipan topping donut halvah halvah. Powder chocolate bar croissant cookie caramels gummies sugar plum.',
                'created_at' => now(),
            ],[
                'name' => 'zosia.nowicka',
                'email' => 'ZosiaNowicka@localhost.local',
                'password' => Hash::make('qwerty123'),
                'first_name' => 'Zosia',
                'last_name' => 'Nowicka',
                'description' => 'Apple pie dragée wafer bear claw chupa chups pastry caramels. Jelly beans icing candy canes cheesecake cake fruitcake marshmallow halvah cotton candy. Dessert cake candy powder pastry cake. Liquorice lollipop candy canes chocolate liquorice.',
                'created_at' => now(),
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Fantastyka',
            'Malarstwo AI',
            'Martwa natura',
            'Ludzie',
            'Akt',
            'Portret',
            'Martwa natura',
            'Weduta',
            'Pejzaż',
            'Marina',
            'Batalistyka',
            'Animalistyka',
            'Malarstwo rodzajowe',
            'Malarstwo religijne',
            'Malarstwo mitologiczne',
            'Malarstwo historyczne',
            'Malarstwo alegoryczne',
            'Malarstwo abstrakcyjne',
        ];

        foreach ($categories as $key => $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => now(),
            ]);
        }
    }
}

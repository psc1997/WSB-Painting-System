<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaintingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paintings = [
            'Czarny kwadrat na białym tle',
            'Kompozycja VII',
            'Mountains and Sea',
            'Full Fathom Five',
            'Broadway Boogie Woogie',
            'Composition X',
            'Pluton, Neptun i Jowisz',
            'Onement I',
            'Fire evening',
            'One: Number 31',
            'The Spring',
            'Colors for a Large Wall',
            'The Talisman',
            'No. 5, 1948',
        ];

        foreach ($paintings as $key => $paint) {
            DB::table('paintings')->insert([
                'name' => $paint,
                'user_id' => rand(1, 5),
                'category_id' => rand(1, 18),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem vero quae repellendus laudantium dolorem error laborum eius accusamus sapiente, deserunt explicabo exercitationem dolore consectetur porro saepe aspernatur quis incidunt nobis.',
                'painting_technique' => 'Olej na płótnie',
                'height' => rand(50, 100),
                'width' => rand(50, 100),
                'created_at' => now(),
            ]);
        }
    }
}

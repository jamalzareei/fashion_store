<?php

use Illuminate\Database\Seeder;

class PageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        for ($i = 1; $i < 100; $i++) {

            \App\Models\Page::create([ //,
            // DB::table('pages')->insert([ //,
                'name' => $faker->name,
                'name_en' => $faker->unique()->username,
                'title' => $faker->title,
                
            ]);

        }
    }
}

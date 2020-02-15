<?php

use Illuminate\Database\Seeder;

class ExtraFieldSeed extends Seeder
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
            for ($j = 1; $j < 20; $j++) {

                DB::table('extra_fields')->insert([ //,
                    'name' => $faker->name,
                    'category_id' => $i,
                    
                ]);

            }
        }
    }
}

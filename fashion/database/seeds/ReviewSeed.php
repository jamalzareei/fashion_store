<?php

use Illuminate\Database\Seeder;

class ReviewSeed extends Seeder
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
            for ($k = 1; $k < 20; $k++) {

                DB::table('reviews')->insert([ //,
                    'ip' => $faker->name,
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'user_id' => $i,
                    'rate' => rand(1,5),
                    'link_page' => $faker->name,
                    'reviewable_id' => $i,
                    'reviewable_type' => 'App\Models\Produc',                
                ]);

            }
        }
        for ($i = 1; $i < 100; $i++) {
            for ($k = 1; $k < 20; $k++) {

                DB::table('reviews')->insert([ //,
                    'ip' => $faker->name,
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'user_id' => $i,
                    'rate' => rand(1,5),
                    'link_page' => $faker->name,
                    'reviewable_id' => $i,
                    'reviewable_type' => 'App\Models\Seller',                
                ]);

            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class SellerSeed extends Seeder
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

            \App\Models\Seller::create([ //,
            // DB::table('sellers')->insert([ //,
                'name' => $faker->title,
                'user_id' => $i,
                'manager' => $faker->title,
                'phones' => $faker->title,
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 1,
                'address' => $faker->address,
                
            ]);

        }
        

    }
}

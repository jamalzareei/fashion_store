<?php

use Illuminate\Database\Seeder;

class AddressSeed extends Seeder
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
            for ($j = 1; $j < 10; $j++) {

                DB::table('addresses')->insert([
                    'user_id' => $i,
                    'name' => $faker->name,
                    'country_id' => 1,
                    'state_id' => 1,
                    'city_id' => 1,
                    'address' => $faker->address,
                ]);

            }
        }
    }
}

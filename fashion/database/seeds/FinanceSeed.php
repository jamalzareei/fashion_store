<?php

use Illuminate\Database\Seeder;

class FinanceSeed extends Seeder
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

            DB::table('finances')->insert([ //,
                'name' =>  $faker->name,
                'bank' => $faker->name,
                'cart_number' => rand(10000,999999),
                'shaba_number' => rand(10000,999999),
                
            ]);

        }
        
    }
}

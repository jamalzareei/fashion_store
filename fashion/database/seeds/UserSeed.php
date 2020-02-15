<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $users = factory(App\User::class, 1000)->create();
        // factory(App\User::class, 50)->create()->each(function($u) {
        //     // $u->posts()->save(factory(App\Post::class)->make());
        // });

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {

            DB::table('users')->insert([ //,
                'uuid' => Str::random(12),
                'username' => $faker->unique()->username,
                'email' => $faker->unique()->email,
                'phone' => $faker->unique()->phoneNumber,
                'password' => bcrypt('secret'),
                
            ]);

        }
    }
}

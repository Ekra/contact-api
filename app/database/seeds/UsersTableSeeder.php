<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/4/15
 * Time: 2:25 PM
 */

use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 50) as $index)
        {
            User::create([
                'username' => $faker->word,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/4/15
 * Time: 2:25 PM
 */

use Faker\Factory as Faker;
class ContactsTableSeeder extends Seeder {
    public  function  run()
    {
        $faker = Faker::create();

        foreach(range(1,70) as $index)
        {
            contact::create([

                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'address' => $faker->address(),
                'twitter' => $faker-> word(),
            ]);
        }
    }
}
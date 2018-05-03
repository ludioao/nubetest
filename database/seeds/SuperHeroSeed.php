<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SuperHeroSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            \DB::table('superheroes')->insert(
                [
                    'nickname' => $faker->userName,
                    'real_name' => $faker->name,
                    'origin_description' => $faker->text(100),
                    'superpowers' => $faker->text(50),
                    'catch_phrase' => $faker->text(10),
                ]);
        }
        //

    }
}

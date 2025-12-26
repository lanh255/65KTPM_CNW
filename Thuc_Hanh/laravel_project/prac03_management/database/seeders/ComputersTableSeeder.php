<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
    $faker = \Faker\Factory::create();
    for($i=0; $i<10; $i++) {
        \DB::table('computers')->insert([
            'computer_name' => 'Lab-PC' . $faker->numberBetween(01, 20),
            'model' => 'Dell Optiplex ' . $faker->numberBetween(3000, 9000),
            'operating_system' => 'Windows 10 Pro',
            'processor' => 'Intel Core i5-11400',
            'memory' => $faker->randomElement([8, 16, 32]),
            'available' => $faker->boolean,
        ]);
    }
}
}

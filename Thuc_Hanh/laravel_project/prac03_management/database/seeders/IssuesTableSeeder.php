<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo 10 máy tính mẫu trước
        for ($i = 0; $i < 10; $i++) {
            DB::table('computers')->insert([
                'computer_name' => 'Lab-PC' . ($i + 1),
                'model' => $faker->randomElement(['Dell Optiplex 7090', 'HP EliteDesk 800', 'Lenovo ThinkCentre']),
                'operating_system' => 'Windows 11 Pro',
                'processor' => 'Core i5-11500',
                'memory' => 16,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tạo 20 vấn đề báo cáo mẫu
        for ($i = 0; $i < 20; $i++) {
            DB::table('issues')->insert([
                'computer_id' => $faker->numberBetween(1, 10),
                'reported_by' => $faker->name,
                'reported_date' => $faker->dateTimeBetween('-1 month', 'now'),
                'description' => $faker->paragraph,
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
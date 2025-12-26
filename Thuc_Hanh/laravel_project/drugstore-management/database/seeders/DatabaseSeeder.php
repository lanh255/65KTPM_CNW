<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Sinh ra 10 bản ghi dữ liệu thuốc giả
        Medicine::factory(10)->create(); //
    }
}
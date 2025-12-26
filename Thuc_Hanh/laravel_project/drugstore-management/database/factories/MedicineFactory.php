<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' Forte',
            'brand' => $this->faker->company,
            'dosage' => $this->faker->randomElement(['500mg', '100mg', '10ml']),
            'form' => $this->faker->randomElement(['Viên nén', 'Viên nang', 'Xi-rô']),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'stock' => $this->faker->numberBetween(10, 500),
        ];
    }
}
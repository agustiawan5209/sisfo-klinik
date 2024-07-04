<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::factory(),
            'alamat'=> fake()->address(),
            'no_telpon'=> fake()->phoneNumber(),
            'tgl_lahir'=> fake()->dateTimeBetween('-3 years', '3 years')->format('Y-m-d'),
        ];
    }
}

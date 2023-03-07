<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'nip' => mt_rand(0000001, 9999999),
            'name' => $faker->name(),
            'jabatan' => $faker->randomElement(['Guru', 'Dokter', 'Peneliti', 'Terknisi Komputer', 'Dosen']),
            'pangkat' => $faker->randomElement(['Bripda', 'Bharada', 'Bharatu', 'Bharaka']),
            'golongan' => $faker->randomElement(['1A', '1B', '2A', '2B']),
        ];
    }
}

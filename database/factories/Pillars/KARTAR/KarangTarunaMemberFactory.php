<?php

namespace Database\Factories\Pillars\KARTAR;

use App\Models\Pillars\Kartar\KarangTaruna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pillars\KARTAR\KarangTarunaMember>
 */
class KarangTarunaMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kartar_id' => KarangTaruna::inRandomOrder()->first()->id,
            'name_member' => $this->faker->name(),
            'nik' => $this->faker->randomNumber(),
            'photo_identity' => md5(time()) . '.png',
            'gender' => 'Laki-Laki',
            'place_of_birth' => 'Sumenep',
            'date_of_birth' => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber(),
            'religion' => 'Islam',
            'last_education' => 'Diploma IV / S1',
            'main_job' => 'Programmer',
            'address' => 'Jl. anonym 23',
            'position' => 'Karyawan'
        ];
    }
}

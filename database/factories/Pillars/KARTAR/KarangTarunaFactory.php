<?php

namespace Database\Factories\Pillars\KARTAR;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pillars\KARTAR\Kartar>
 */
class KarangTarunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kartar' => $this->faker->name(),
            'alamat_sekretariat' => $this->faker->address(),
            'foto_sekretariat' => time() . '.png',
            'kota' => $this->faker->city(),
            'kecamatan' => $this->faker->city(),
            'desa' => $this->faker->city(),
            'no_telp_sekretariat' => $this->faker->phoneNumber(),
            'email_kartar' => $this->faker->email(),
            'no_sk' => $this->faker->randomNumber(5),
            'tanggal_sk' => $this->faker->date(),
            'penandatangan_sk' => $this->faker->text(10),
            'selaku' => $this->faker->name(),
            'file_sk' => time() . '.png',
            'nama_ketua_kartar' => $this->faker->name(),
            'no_telp_wa' => $this->faker->phoneNumber(),
            'foto_ketua' => time() . '.png',
            'jumlah_anggota_laki_laki' => $this->faker->numberBetween(1, 100),
            'jumlah_anggota_perempuan' => $this->faker->numberBetween(1, 100),
            'jumlah_pengurus_laki_laki' => $this->faker->numberBetween(1, 100),
            'jumlah_pengurus_perempuan' => $this->faker->numberBetween(1, 100),
            'klasifikasi_kartar' => 'Tumbuh',
            'status_kinerja' => 'Aktif',
            'status' => 'Lengkap'
        ];
    }
}

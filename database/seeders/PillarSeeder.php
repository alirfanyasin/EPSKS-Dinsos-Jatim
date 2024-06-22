<?php

namespace Database\Seeders;

use App\Models\Pillars\Pillar;
use Illuminate\Database\Seeder;

/**
 * Class PillarSeeder
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */
class PillarSeeder extends Seeder
{
    private array $pillars = [
        ['code' => 'TKSK', 'name' => 'Tenaga Kesejahteraan Sosial Kecamatan'],
        ['code' => 'PSM', 'name' => 'Pekerja Sosial Masyarakat'],
        ['code' => 'KARTAR', 'name' => 'Karang Taruna'],
        ['code' => 'LKS', 'name' => 'Lembaga Kesejahteraan Sosial'],
        ['code' => 'PKH', 'name' => 'Program Keluarga Harapan'],
        ['code' => 'ASPD', 'name' => 'Asistensi Social Pendamping Disabilitas'],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->pillars as $pillar) {
            Pillar::query()->create($pillar);

            dump("Pillar {$pillar['name']} created");
        }
    }
}

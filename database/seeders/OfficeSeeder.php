<?php

namespace Database\Seeders;

use App\Models\Utilities\Province;
use App\Models\Utilities\Regency;
use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::query()->create([
           'name' => 'DINAS SOSIAL JAWA TIMUR',
        ]);

        $province = Province::query()->where('name', 'JAWA TIMUR')->first();
        $regencies = Regency::query()->where('province_id', $province->id)->get();

        foreach ($regencies as $item) {
            Office::query()->create([
                'name' => 'DINAS SOSIAL ' . $item->name,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Pillars\Kartar\KarangTarunaMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KarangTarunaMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KarangTarunaMember::factory(20)->create();
    }
}

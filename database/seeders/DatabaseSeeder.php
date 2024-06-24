<?php

namespace Database\Seeders;

use App\Models\Pillars\ASPD\ASPDQuota;
use Database\Seeders\utilities\IndoRegionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // utilities
        $this->call(IndoRegionSeeder::class);
        $this->call(PillarSeeder::class);

        $this->call(OfficeSeeder::class);
        $this->call(RoleAndPermissions::class);
        $this->call(UsersSeeder::class);

        $this->call(DummyPillarSeeder::class);

        $this->call(ASPDQuotaSeeder::class);

        // $this->call(KarangTarunaSeeder::class);
        // $this->call(KarangTarunaMemberSeeder::class);
    }
}

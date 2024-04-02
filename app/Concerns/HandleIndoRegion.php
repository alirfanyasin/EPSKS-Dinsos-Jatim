<?php

namespace App\Concerns;

use App\Models\Utilities\District;
use App\Models\Utilities\Regency;
use App\Models\Utilities\Village;

/**
 * Trait HandleIndoRegion
 * Author: Chrisdion Andrew
 * Date: 8/7/2023
 */

trait HandleIndoRegion
{
    /**
     * Handle Kabupaten / Kota
     * @param string $name
     * @return string|null
     */
    private function handleRegency(string $name): ?string
    {
        $query =  Regency::query()->select('name')->where('name', 'LIKE', '%' . $name . '%')->first();
        return $query->name ?? null;
    }

    /**
     * Handle Kecamatan
     * @param string $name
     * @return string|null
     */
    private function handleDistrict(string $name): ?string
    {
        $query =  District::query()->select('name')->where('name', 'LIKE', '%' . $name . '%')->first();
        return $query->name ?? null;
    }

    /**
     * Handle Desa / Kelurahan
     * @param string $name
     * @return string|null
     */
    private function handleVillage(string $name): ?string
    {
        $query =  Village::query()->select('name')->where('name', 'LIKE', '%' . $name . '%')->first();
        return $query->name ?? null;
    }
}

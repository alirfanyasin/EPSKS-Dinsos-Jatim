<?php

namespace Database\Seeders;

use Database\Seeders\roles\AdminSeederRolePermissions;
use Database\Seeders\roles\EmployeeSeederRolePermissions;
use Database\Seeders\roles\SuperAdminRolePermissions;
use Illuminate\Database\Seeder;

/**
 * Class RoleAndPermissions
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class RoleAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminRolePermissions::class,
            AdminSeederRolePermissions::class,
            EmployeeSeederRolePermissions::class,
        ]);
    }
}

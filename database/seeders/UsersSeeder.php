<?php

namespace Database\Seeders;

use Database\Seeders\users\SuperAdminSeeder;
use Database\Seeders\users\AdminSeeder;
use Database\Seeders\users\EmployeeSeeder;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            AdminSeeder::class,
//            EmployeeSeeder::class,
        ]);
    }
}

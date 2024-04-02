<?php

namespace Database\Seeders\users;

use App\Models\Office;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class SuperAdminSeeder
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class SuperAdminSeeder extends Seeder
{
    private const ROLE = User::ROLE_SUPER_ADMIN;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName(self::ROLE);
        $faker = \Faker\Factory::create('id_ID');

        $offices = Office::query()->get();

        $offices->each(function ($office) use ($faker, $role) {
            $superAdmin = User::query()->create([
                'nip' => $faker->unique()->randomNumber(9),
                'username' => strtolower(str_replace(' ', '', $office->name)),
                'name' => $office->name,
                'email' => strtolower(str_replace(' ', '', $office->name)) . '@mail.com',
                'password' => 'password',
                'office_id' => $office->id,
            ]);

            dump("Super Admin {$superAdmin->name} created");

            $superAdmin->assignRole(self::ROLE);
            $superAdmin->syncPermissions($role->permissions);
        });
    }
}

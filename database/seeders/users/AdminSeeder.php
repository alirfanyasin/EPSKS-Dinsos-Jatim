<?php

namespace Database\Seeders\users;

use App\Models\Office;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class AdminSeeder
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class AdminSeeder extends Seeder
{
    private const ROLE = User::ROLE_ADMIN;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $role = Role::findByName(self::ROLE);

        $pillars = Pillar::query()->get();
        $offices = Office::query()->get();

        $pillars->each(function ($pillar) use ($faker, $role, $offices) {
            $offices->each(function ($office) use ($faker, $role, $pillar) {
                $admin = User::query()->create([
                    'nip' => $faker->unique()->randomNumber(9),
                    'username' => strtolower(str_replace(' ', '', $office->name)) . strtolower($pillar->code),
                    'name' => $office->name . ' ' . $pillar->code,
                    'email' => strtolower(str_replace(' ', '', $office->name)) . strtolower($pillar->code) . '@gmail.com',
                    'password' => 'password',
                    'office_id' => $office->id,
                    'pillar_id' => $pillar->id,
                ]);

                dump("Admin {$admin->name} created");

                $admin->assignRole(self::ROLE);
                $admin->syncPermissions($role->permissions);
            });
        });
    }
}

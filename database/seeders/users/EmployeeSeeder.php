<?php

namespace Database\Seeders\users;

use App\Models\Office;
use App\Models\Pillars\Pillar;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class EmployeeSeeder
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class EmployeeSeeder extends Seeder
{
    private const ROLE = User::ROLE_EMPLOYEE;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $role = Role::findByName(self::ROLE);

        foreach (Pillar::query()->get() as $key => $pillar) {
            $employee = User::query()->create([
                'nip' => '12345678' . $key + 1,
                'username' => 'pegawai' . strtolower($pillar->code),
                'name' => 'Pegawai ' . $pillar->code,
                'email' => 'pegawai' . strtolower($pillar->code) . '@gmail.com',
                'password' => 'password',
                'is_employee' => true,
                'pillar_id' => $pillar->id,
                'office_id' => 38, // surabaya
            ]);

            dump("Employee {$employee->name} created");

            $employee->assignRole(self::ROLE);
            dump("Employee {$employee->name} assigned role {$role->name}");

            $employee->syncPermissions($role->permissions);
        }

        //        $offices = Office::query()->whereIn('name', ['DINAS SOSIAL KOTA SURABAYA', 'DINAS SOSIAL KABUPATEN SIDOARJO'])->get();
        //
        //        $offices->map(function ($office) use ($faker) {
        //            $user = User::query()->create([
        //                'nip' => $faker->unique()->randomNumber(9),
        //                'username' => 'tksk' . $faker->unique()->randomNumber(3),
        //                'name' => $faker->name,
        //                'email' => 'tksk' . $faker->unique()->randomNumber(3) . '@mail.com',
        //                'password' => 'password',
        //                'office_id' => $office->id,
        //                'pillar' => User::PILLAR_TKSK,
        //                'is_employee' => true,
        //            ]);
        //
        //            $user->assignRole(self::ROLE);
        //        });
    }
}

<?php

namespace Database\Seeders\roles;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class EmployeeSeederRolePermissions
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class EmployeeSeederRolePermissions extends Seeder
{
    private const ROLE = User::ROLE_EMPLOYEE;

    public function permissions(): Collection
    {
        return collect([
            // TKSK
            'edit own tksk',
            'view own tksk',
            'view own tksk report',
            'create tksk report',
            'update own tksk report',
            'delete own tksk report',
            'download own tksk report',
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::query()->create([
            'name' => self::ROLE,
        ]);

        $this->permissions()->each(function ($permission) use ($role) {
            $permission = Permission::query()->updateOrCreate([
                'name' => $permission,
            ]);

            $role->givePermissionTo($permission);
        });
    }
}

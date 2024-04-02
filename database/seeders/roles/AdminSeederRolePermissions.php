<?php

namespace Database\Seeders\roles;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class AdminSeederRolePermissions
 * Author: Chrisdion Andrew
 * Date: 6/19/2023
 */

class AdminSeederRolePermissions extends Seeder
{
    private const ROLE = User::ROLE_ADMIN;

    public function permissions(): Collection
    {
        return collect([
            // TODO: Update permissions list
            'create tksk',
            'read tksk',
            'update tksk',
            'delete tksk',
            'import tksk',
            'view tksk report',
            'approval tksk',
            'approval tksk report',
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

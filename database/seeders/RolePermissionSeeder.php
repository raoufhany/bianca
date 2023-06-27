<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $generalPermissions = [
            'general-all',
            'dashboard-show',
            'restaurants-index',
            'restaurants-create',
            'restaurants-edit',
            'restaurants-delete',
            'tables-index',
            'tables-create',
            'tables-edit',
            'tables-delete',
            'menus-index',
            'menus-create',
            'menus-edit',
            'menus-delete',
            'categories-index',
            'categories-create',
            'categories-edit',
            'categories-delete',
            'items-index',
            'items-create',
            'items-edit',
            'items-delete',
            'item-extras-index',
            'item-extras-create',
            'item-extras-edit',
            'item-extras-delete',
        ];

        foreach ($generalPermissions as $generalPermission) {
            Permission::findOrCreate($generalPermission);
        }

        $data = [
            'Super Admin' => [
                'general-all'
            ],
            'Restaurant Owner' => [
                'dashboard-show',
                'tables-index',
                'tables-create',
                'tables-edit',
                'tables-delete',
                'menus-index',
                'menus-create',
                'menus-edit',
                'menus-delete',
                'categories-index',
                'categories-create',
                'categories-edit',
                'categories-delete',
                'items-index',
                'items-create',
                'items-edit',
                'items-delete',
                'item-extras-index',
                'item-extras-create',
                'item-extras-edit',
                'item-extras-delete',
            ],
            'User' => [

            ],
        ];

        foreach ($data as $role => $permissions) {
            $role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                $permission = Permission::findOrCreate($permission);
                $role->givePermissionTo($permission);
            }
        }
    }
}

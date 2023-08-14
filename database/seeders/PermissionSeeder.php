<?php

namespace Database\Seeders;

use App\Constants\Guard;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_groups = $this->permissions();

        $permissions = [];

        foreach ($permission_groups as $guard => $group_values) {

            ksort($group_values);

            foreach ($group_values as $group_name => $actions) {

                $permission_group = PermissionGroup::firstOrCreate(['guard_name' => $guard, 'name' => $group_name]);

                foreach ($actions as $action) {
                    $permissions[] = ['name' => "{$group_name}.{$action}", 'guard_name' => $guard, 'permission_group_id' => $permission_group->id];
                }
            }
        }

        foreach (array_chunk($permissions, 30) as $chunked_permissions) {
            Permission::upsert($chunked_permissions, ['guard_name', 'name', 'permission_group_id']);
        }
    }

    protected function permissions()
    {
        return [
            Guard::ADMIN => [
                'dashboard' => [
                    'read'
                ],
                'admin' => [
                    'create',
                    'read',
                    'update',
                    'delete'
                ],
                'user' => [
                    'create',
                    'read',
                    'update',
                    'delete'
                ],
                'company' => [
                    'create',
                    'read',
                    'update',
                    'delete'
                ],

            ]
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use App\Constants\Guard;
use App\Constants\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::firstOrCreate(['name' => Role::ROLE_SUPER_ADMIN, 'guard_name' => Guard::ADMIN]);

        $admin = Admin::updateOrCreate(
            ['email' => 'superadmin@businesscard.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => Status::ADMIN_STATUS_ACTIVE
            ]
        );

        if (!is_bool($admin)) {
            $admin->assignRole($superadmin->name);
        }
    }
}

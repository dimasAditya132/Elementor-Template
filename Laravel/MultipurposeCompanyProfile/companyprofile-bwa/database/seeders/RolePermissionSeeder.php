<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]
            );
        }

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $designManagerRole = Role::firstOrCreate([
            'name' => 'design_manager'
        ]);

        $designManagerPermission = [
            'manage products',
            'manage principles',
            'manage testimonials'
        ];

        $designManagerRole->syncPermissions($designManagerPermission);

        $user = User::create([
            'name' => 'AdminCompro',
            'email' => 'super@admin.com',
            'password' => bcrypt('123123123'),
        ]);

        $user->assignRole($superAdminRole);
    }
}

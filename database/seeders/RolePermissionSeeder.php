<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        // $superAdminRole = Role::create(['name' => 'Super Admin']);
        // $adminRole = Role::create(['name' => 'Admin']);
        // $editorRole = Role::create(['name' => 'Editor']);
        // $userRole = Role::create(['name' => 'User']);

        // Permissions
        $permissions = [
            [
                'group_name' => "dashboard",
                'permissions' => [
                    'dashboard.view'
                ]
            ],
            [
                'group_name' => "role",
                'permissions' => [
                    'role.view',
                    'role.create',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => "admin",
                'permissions' => [
                    'admin.view',
                    'admin.create',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => "user",
                'permissions' => [
                    'user.view',
                    'user.edit',
                    'user.delete',
                ]
            ],
            [
                'group_name' => "country",
                'permissions' => [
                    'country.view',
                    'country.create',
                    'country.edit',
                    'country.delete',
                ]
            ],
            [
                'group_name' => "server",
                'permissions' => [
                    'server.view',
                    'server.create',
                    'server.edit',
                    'server.delete',
                ]
            ],
            [
                'group_name' => "package_pricing",
                'permissions' => [
                    'package_pricing.view',
                    'package_pricing.create',
                    'package_pricing.edit',
                    'package_pricing.delete',
                ]
            ],
            [
                'group_name' => "notification",
                'permissions' => [
                    'notification.send',
                ]
            ],
            [
                'group_name' => "page",
                'permissions' => [
                    'page.view',
                    'page.create',
                    'page.edit',
                    'page.delete',
                ]
            ],
            [
                'group_name' => "email-settings",
                'permissions' => [
                    'email-settings.view',
                    'email-configuration.edit',
                    'email-templates.edit',
                    'email-global-templates.edit',
                ]
            ],
            [
                'group_name' => "settings",
                'permissions' => [
                    'settings.view',
                    'notification-settings.view',
                    'notification-settings.edit',
                    'advertisement-settings.view',
                    'advertisement-settings.edit',
                    'app-settings.view',
                    'app-settings.edit',
                ]
            ],
        ];

        // for ($i = 0; $i < count($permissions); $i++) {
        //     $permission = Permission::create(['name' => $permissions[$i]]);
        //     $superAdminRole->givePermissionTo($permission);
        //     $permission->assignRole($superAdminRole);
        // }

        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);

        for ($i = 0; $i < count($permissions); $i++) {
            $groupName = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $groupName, 'guard_name' => 'admin']);
                $superAdminRole->givePermissionTo($permission);
                $permission->assignRole($superAdminRole);
            }
        }

        
        $admin = Admin::where('username', 'admin')
                        ->orWhere('email', 'admin@gmail.com')
                        ->first();

        if ($admin) {
            $admin->assignRole($superAdminRole);
        }
    }
}

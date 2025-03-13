<?php

namespace Database\Seeders;

use App\Models\User;
use DirectoryTree\Authorization\Permission;
use DirectoryTree\Authorization\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'localho2020@gmail.com',
        ]);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@test.com',
        ]);

        // ROLES
        $superadmin = Role::query()->create([
            'name' => 'superadmin',
            'label' => 'SuperAdmin',
        ]);
        $admin = Role::query()->create([
            'name' => 'admin',
            'label' => 'Admin',
        ]);

        // PERMISSIONS
        // SUPERADMIN
        $createUser = Permission::query()->create([
            'name' => 'user.create',
            'label' => 'Create Users',
        ]);
        $deleteUser = Permission::query()->create([
            'name' => 'user.delete',
            'label' => 'Delete Users',
        ]);
        $listUser = Permission::query()->create([
            'name' => 'user.list',
            'label' => 'List Users',
        ]);
        $editUser = Permission::query()->create([
            'name' => 'user.edit',
            'label' => 'Edit Users',
        ]);

        // OPG Permissions
        $superadmin->permissions()->save($createUser);
        $superadmin->permissions()->save($deleteUser);
        $superadmin->permissions()->save($listUser);
        $superadmin->permissions()->save($editUser);

        // ADMIN Permissions
        // $admin->permissions()->save($createOrder);
        // $admin->permissions()->save($deleteOrder);
        // $admin->permissions()->save($listOrder);
        // $admin->permissions()->save($editOrder);

        // Set roles for user
        $superAdmin->roles()->save($superadmin);
        $adminUser->roles()->save($admin);
    }
}

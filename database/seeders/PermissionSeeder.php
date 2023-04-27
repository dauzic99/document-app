<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Manajemen User']);
        Permission::create(['name' => 'Manajemen Dokumen']);


        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('Manajemen User');
        $role1->givePermissionTo('Manajemen Dokumen');

        $role2 = Role::create(['name' => 'Operator']);
        $role2->givePermissionTo('Manajemen Dokumen');


        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $user = \App\Models\User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@mail.com',
        ]);
        $user->assignRole($role3);
    }
}

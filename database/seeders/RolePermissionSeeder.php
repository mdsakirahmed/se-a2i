<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    public function run()
    {
        Permission::insert([
            ['name' => 'user management', 'guard_name' => 'web'],
            ['name' => 'role permission management', 'guard_name' => 'web'],
            ['name' => 'chart info edit', 'guard_name' => 'web'],
        ]);
        
        //Role
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $editor = Role::create(['name' => 'editor']);
        $editor->syncPermissions(['chart info edit']);

        $viewer = Role::create(['name' => 'viewer']);

    }
}

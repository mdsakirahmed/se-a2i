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
            ['name' => 'manage language', 'guard_name' => 'web'],
            ['name' => 'manage user', 'guard_name' => 'web'],
            ['name' => 'view dashboard', 'guard_name' => 'web'],
            ['name' => 'upload file', 'guard_name' => 'web'],
            ['name' => 'view file', 'guard_name' => 'web'],
            ['name' => 'update chart info', 'guard_name' => 'web'],
            ['name' => 'manager file information', 'guard_name' => 'web'],
        ]);
        
        //Role
        $role = Role::create(['name' => 'Admin']);
        $role->syncPermissions(Permission::all());
    }
}

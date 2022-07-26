<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'permission_manager@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::insert([
            ['name' => 'Language Manager', 'email' => 'language_manager@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'Dashboard Viewer', 'email' => 'dashboard_viewer@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'File Uploader', 'email' => 'file_uploader@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'File Viewer', 'email' => 'file_viewer@gmail.com', 'password' => bcrypt('password')],
        ]);
    }
}

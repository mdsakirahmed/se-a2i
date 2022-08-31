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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('editor');

        User::create([
            'name' => 'Viewer',
            'email' => 'viewer@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('viewer');
    }
}

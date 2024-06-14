<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
           'name' => 'Admin',
           'email' => 'admin@local',
           'password' => bcrypt('adminadmin'),
        ]);

        $user->assignRole(Role::ADMIN);
    }
}

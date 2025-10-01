<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin roles
        Role::create(['name' => 'admin']);

        // Regular control entity user role
        Role::create(['name' => 'control_entity_user']);

        // Resolution user role
        Role::create(['name' => 'resolution_user']);

        // Regular user role
        Role::create(['name' => 'user']);
    }
}

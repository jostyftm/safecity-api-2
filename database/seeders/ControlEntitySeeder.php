<?php

namespace Database\Seeders;

use App\Models\ControlEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ControlEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ControlEntity::factory()->count(5)->create()->each(function (ControlEntity $controlEntity) {

            // Create user with control_entity_user role
            $userAdmin = \App\Models\User::factory()->create();
            $userAdmin->assignRole('control_entity_user');
            $controlEntity->users()->attach($userAdmin);

            // Create user with resolution_user role
            $userResolution = \App\Models\User::factory()->count(10)->create()
                ->each(function ($user) use ($controlEntity) {
                    $user->assignRole('resolution_user');

                    $controlEntity->users()->attach($user);
                });
        });
    }
}

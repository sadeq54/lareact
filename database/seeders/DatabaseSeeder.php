<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    
public function run(): void
    {
        // User::factory(10)->create();

        $UserRole = Role::create(['name' => RolesEnum::User->value]);
        $AdminRole = Role::create(['name' => RolesEnum::Admin->value]);
        $CommenterRole = Role::create(['name' => RolesEnum::Commenter->value]);

        $mangeFeaturesPermissions = Permission::create(['name' => PermissionsEnum::ManageFeatures->value]);
        $mangeUsersPermissions = Permission::create(['name' => PermissionsEnum::ManageUsers->value]);
        $mangeCommentsPermissions = Permission::create(['name' => PermissionsEnum::ManageComments->value]);
        $upvoteDownvotePermissions = Permission::create(['name' => PermissionsEnum::UpvoteDownvote->value]);

        $UserRole->syncPermissions([
            $upvoteDownvotePermissions,
        ]);

        $AdminRole->syncPermissions([
            $mangeFeaturesPermissions,
            $mangeUsersPermissions,
            $mangeCommentsPermissions,
            $upvoteDownvotePermissions,
        ]);

        $CommenterRole->syncPermissions([
            $upvoteDownvotePermissions,
            $mangeCommentsPermissions
        ]);

        User::factory()->create([
            'name' => 'User User',
            'email' => 'User@example.com',
        ])->assignRole(RolesEnum::User);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::Admin);

        User::factory()->create([
            'name' => 'Commenter User',
            'email' => 'commenter@example.com',
        ])->assignRole(RolesEnum::Commenter);
    }
}
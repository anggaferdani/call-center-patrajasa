<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'role-index',
            'role-create',
            'role-show',
            'role-edit',
            'role-delete',
        ];
        
        collect($permissions)->each(function ($permission) {
            Permission::create(['name' => $permission]);
        });

        $user = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        $role = Role::create(['name' => 'Superdmin']);
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}

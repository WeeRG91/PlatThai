<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Permissions\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlatPermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $this->updateAdminPermissions();
    }

    /**
     * Pour mettre à jour les permissions du role 'admin'
     * À chaque fois que des seeders seront ajoutés, cette fonction mettra à jour les permissions admin
     * (un admin doit avoir toutes les permissions)
     * @return void
     */
    private function updateAdminPermissions()
    {
        $permissions = Permission::all();
        $adminRole = Role::where('name', RoleType::ADMIN)->first();
        $adminRole->permissions()->sync($permissions);
    }
}

<?php

namespace Database\Seeders;

use App\Enums\Permissions\IngredientPermissionType;
use App\Enums\Permissions\PermissionType;
use App\Enums\Permissions\PlatPermissionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class IngredientPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (IngredientPermissionType::getConstants() as $permission){
            if(!Permission::where(['name' => $permission, 'type' => PermissionType::INGREDIENT, 'guard_name' => 'web'])->first()) {
                Permission::create([
                    'name' => $permission,
                    'type' => PermissionType::INGREDIENT,
                    'guard_name' => 'web'
                ]);
            }
        }
    }
}

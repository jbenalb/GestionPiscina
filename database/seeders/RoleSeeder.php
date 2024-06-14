<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\Role as RoleEnum;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $roleAdmin = Role::create(['name' => RoleEnum::ADMIN]);
        $roleUser = Role::create(['name' => RoleEnum::USUARIO]);

        // Crear permisos
        $permissions = [
            'view-calendar',
            'create-cita',
            'delete-own-cita',
            'delete-any-cita'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos a roles
        $roleAdmin->givePermissionTo([
            'view-calendar',
            'create-cita',
            'delete-own-cita',
            'delete-any-cita'
        ]);

        $roleUser->givePermissionTo([
            'view-calendar',
            'create-cita',
            'delete-own-cita'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'donatur',
            'ngo'
        ];

        foreach ($roles as $role) {
            $toRole = Role::firstOrCreate(['name' => $role]);
            $toRole->givePermissionTo(Permission::all());
        }
    }
}

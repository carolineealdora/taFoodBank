<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolenSeeder2 extends Seeder
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

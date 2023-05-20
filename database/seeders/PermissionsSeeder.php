<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'list',
            'create',
            'edit',
            'delete'
        ];

        foreach ($permissions as $permission) {
            $toPermission = Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}

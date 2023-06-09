<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KategoriSeeder::class);
        $this->call(KotaSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(StatusDonasiSeeder::class);
        $this->call(AdminSeeder::class);
    }
}

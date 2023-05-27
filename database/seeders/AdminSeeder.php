<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            "foto_profil"   => 'kosong',
            "no_identitas"  => '000000000'
        ];

        $admin_credentials = [
            "nama"      => 'admin',
            "email"     => "admin1@gmail.com",
            "password"  => Hash::make('123')
        ];

        Admin::firstOrCreate($admin);
        User::firstOrCreate($admin_credentials)->assignRole('admin');
    }
}

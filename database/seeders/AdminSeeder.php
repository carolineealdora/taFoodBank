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
        // $admin_credentials = [
        //     "nama"      => 'admin',
        //     "email"     => "admin1@gmail.com",
        //     "password"  => Hash::make('123')
        // ];

        // User::firstOrCreate($admin_credentials)->assignRole('admin');

        $admin = [
            'user_id'       => 29,
            "foto_profil"   => 'images/admin/bLOMHnyvS1HYlaLvAjddcst2CoUgc5vnfRg7VNaq.jpg',
            "no_identitas"  => '000000000'
        ];

        Admin::firstOrCreate($admin);

    }
}

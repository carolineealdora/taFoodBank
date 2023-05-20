<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Seeder;

class StatusDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kotas = [
            'Malang',
            'Surabaya',
            'Jakarta'
        ];

        foreach ($kotas as $kota) {
            $toKota = Kota::firstOrCreate(['nama' => $kota]);
        }
    }
}

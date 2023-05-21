<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuans = [
            'Kilogram',
            'Liter',
            'Pieces'
        ];

        foreach ($satuans as $satuan) {
            $toSatuan = Satuan::firstOrCreate(['nama' => $satuan]);
        }
    }
}

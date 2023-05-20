<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jeniss = [
            'Makanan',
            'Minuman',
            'Barang'
        ];

        foreach ($jeniss as $jenis) {
            $toSatuan = Jenis::firstOrCreate(['nama' => $jenis]);
        }
    }
}

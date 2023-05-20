<?php

namespace Database\Seeders;

use App\Models\StatusDonasi;
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
        $statuses = [
            'submitted',
            'approved',
            'rejected',
            'pickedup',
            'finished'
        ];

        foreach ($statuses as $status) {
            $toStatus = StatusDonasi::firstOrCreate(['nama' => $status]);
        }
    }
}

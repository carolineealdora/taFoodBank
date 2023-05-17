<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function tesData()
    {
        DB::table('donasi_konsumsi')->insert(['kd_id' => '1', 'kd_nama'=> 'makanan1']);
    }
}

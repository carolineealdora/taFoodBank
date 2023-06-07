<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateeDonasiViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("Create View views_donasi As select dk.id, u.nama as nama_user, dk.nama as donasi_konsumsi, sd.nama as status_donasi, d.ngo_tujuan, d.donatur as donatur, dk.created_at as tanggal from donasi_konsumsi dk inner join donasi as d on dk.donasi_id =  d.id inner join status_donasi sd on sd.id = d.status_donasi inner join donatur dt on dt.id = d.donatur inner join users u on dt.user_id = u.id;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

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
        // DB::statement("Create View views_donasi As select dk.id,
        // u.nama as nama_user,
        // dk.nama as donasi_konsumsi,
        // sd.nama as status_donasi,
        // d.ngo_tujuan,
        // dk.donasi_id as donasi,
        // d.donatur as donatur,
        // dk.created_at as tanggal from donasi_konsumsi dk inner join donasi as d on dk.donasi_id = d.id inner join status_donasi sd on sd.id = d.status_donasi inner join donatur dt on dt.id = d.donatur inner join users u on dt.user_id = u.id;");
        DB::statement("
            CREATE VIEW views_donasi AS
            SELECT dk.id, u.nama AS nama_user, dk.nama AS donasi_konsumsi, sd.nama AS status_donasi,
            d.ngo_tujuan, n.ngo_nama AS ngo_nama, dk.donasi_id AS donasi, d.donatur AS donatur, dk.created_at AS tanggal
            FROM donasi_konsumsi dk
            INNER JOIN donasi AS d ON dk.donasi_id = d.id
            INNER JOIN status_donasi sd ON sd.id = d.status_donasi
            INNER JOIN donatur dt ON dt.id = d.donatur
            INNER JOIN users u ON dt.user_id = u.id
            INNER JOIN ngo n ON d.ngo_tujuan = n.id;
        ");
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

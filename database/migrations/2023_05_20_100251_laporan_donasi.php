<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_donasi', function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('donasi_id');
            $table->foreign('donasi_id')->references('id')->on('donasi')->onDelete('cascade');
            $table->string('foto_laporan');
            $table->mediumtext('deskripsi');
            $table->timestamps();
        });
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

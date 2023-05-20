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
            $table->unsignedBigInteger('donasi');
            $table->foreign('donasi')->references('id')->on('donasi')->onDelete('cascade');
            $table->binary('foto_laporan');
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

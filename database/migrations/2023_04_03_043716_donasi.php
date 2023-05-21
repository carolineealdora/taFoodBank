<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id');
            // $table->unsignedBigInteger('donatur');
            // $table->foreign('donatur')->references('don_id')->on('donatur');
            // $table->unsignedBigInteger('konsumsi');
            // $table->foreign('konsumsi')->references('kd_id')->on('donasi_konsumsi');
            $table->unsignedBigInteger('donatur');
            $table->foreign('donatur')->references('id')->on('donatur');
            $table->unsignedBigInteger('ngo_tujuan');
            $table->foreign('ngo_tujuan')->references('id')->on('ngo');
            $table->unsignedBigInteger('kota');
            $table->foreign('kota')->references('id')->on('kota');
            $table->string('nama_pickup', 200);
            $table->string('alamat_pickup', 200);
            $table->string('no_telp_pickup', 20);
            $table->unsignedBigInteger('status_donasi');
            $table->foreign('status_donasi')->references('id')->on('status_donasi');
            // $table->unsignedBigInteger('pickup');
            // $table->foreign('pickup')->references('p_id')->on('pickup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};

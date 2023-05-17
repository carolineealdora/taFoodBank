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
        Schema::create('donasi_konsumsi', function (Blueprint $table){
            $table->id('kd_id');
            $table->unsignedBigInteger('donasi');
            $table->foreign('donasi')->references('d_id')->on('donasi')->onDelete('cascade');
            $table->string('kd_nama', 200);
            $table->binary('kd_photo');
            $table->mediumtext('kd_deskripsi');
            $table->unsignedBigInteger('kategori');
            $table->foreign('kategori')->references('kat_id')->on('kategori');
            $table->unsignedBigInteger('jenis');
            $table->foreign('jenis')->references('jen_id')->on('jenis');
            $table->unsignedBigInteger('satuan');
            $table->foreign('satuan')->references('sat_id')->on('satuan');
            $table->integer('kd_kuantitas');
            $table->date('kd_expired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_konsumsi');
    }
};

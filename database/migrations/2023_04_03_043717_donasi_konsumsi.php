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
        $table->id('id');
        $table->unsignedBigInteger('donasi_id');
        $table->foreign('donasi_id')->references('id')->on('donasi')->onDelete('cascade');
        $table->string('nama', 200);
        $table->string('photo', 200);
        $table->mediumtext('deskripsi');
        $table->unsignedBigInteger('kategori');
        $table->foreign('kategori')->references('id')->on('kategori');
        $table->unsignedBigInteger('satuan');
        $table->foreign('satuan')->references('id')->on('satuan');
        $table->integer('kuantitas');
        $table->date('expired')->nullable();
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

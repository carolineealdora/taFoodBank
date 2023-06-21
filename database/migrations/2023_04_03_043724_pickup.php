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
        Schema::create('pickup', function(Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('donasi_id');
            $table->foreign('donasi_id')->references('id')->on('donasi')->onDelete('cascade');
            $table->string('nama', 200);
            $table->string('photo');
            $table->mediumtext('deskripsi');
            $table->unsignedBigInteger('kategori');
            $table->foreign('kategori')->references('id')->on('kategori');
            $table->unsignedBigInteger('satuan');
            $table->foreign('satuan')->references('id')->on('satuan');
            $table->integer('kuantitas');
            $table->date('expired');
            $table->dateTime('waktu_pickup')->nullable()->change();
            $table->timestamps();
        });

    //     DB::unprepared('
    //     CREATE TRIGGER copy_donasi_konsumsi
    //     AFTER INSERT ON donasi_konsumsi
    //     FOR EACH ROW
    //     BEGIN
    //     INSERT INTO pickup (p_nama, p_photo, p_deskripsi, kategori, jenis, satuan, p_kuantitas, p_expired) VALUES (NEW.kd_nama, NEW.kd_photo, NEW.kd_deskripsi, NEW.kategori, NEW.jenis, NEW.satuan, NEW.kd_kuantitas, NEW.kd_expired);
    //     END;
    // ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup');
        // DB::unprepared('DROP TRIGGER IF EXISTS copy_donasi_konsumsi');
    }
};

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
        Schema::create('donatur', function (Blueprint $table) {
            $table->id('don_id');
            $table->binary('don_photo');
            $table->string('don_nama', 200);
            $table->string('don_alamat', 200);
            $table->string('don_no_id', 16);
            $table->date('don_tanggal_lahir');
            $table->string('don_no_telp', 20);
            $table->string('don_email', 50)->unique();
            $table->string('don_password', 60);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};

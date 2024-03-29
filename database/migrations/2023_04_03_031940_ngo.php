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
        Schema::create('ngo', function (Blueprint $table) {
            $table->id('id');
            $table->tinyInteger('ngo_status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('ngo_nama', 200);
            $table->string('ngo_alamat', 200);
            $table->unsignedBigInteger('ngo_kota');
            $table->foreign('ngo_kota')->references('id')->on('kota');
            $table->string('ngo_no_telp', 20);
            $table->string('pic_foto');
            $table->string('no_identitas', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngo');
    }
};

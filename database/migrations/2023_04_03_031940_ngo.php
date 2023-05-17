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
            $table->id('ngo_id');
            $table->tinyInteger('ngo_status')->default(0);
            // $table->unsignedBigInteger('status');
            // $table->foreign('status')->references('stngo_id')->on('status_ngo');
            $table->unsignedBigInteger('pic');
            $table->foreign('pic')->references('pic_id')->on('pic');
            $table->string('ngo_nama', 200);
            $table->string('ngo_alamat', 200);
            $table->unsignedBigInteger('kota');
            $table->foreign('kota')->references('kot_id')->on('kota');
            $table->string('ngo_no_telp', 20);
            $table->string('ngo_email', 50)->unique();
            $table->string('ngo_password', 60);
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

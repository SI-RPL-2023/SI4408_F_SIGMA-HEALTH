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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_reservasi');
            $table->string('no_rekam_medis');
            $table->string('obat');
            $table->timestamps();

            $table->foreign('kode_reservasi')->references('kode_reservasi')->on('reservasi');
            $table->foreign('no_rekam_medis')->references('no_rekam_medis')->on('pasien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};

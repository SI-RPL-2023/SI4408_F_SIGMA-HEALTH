<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->string('kode_reservasi')->primary();
            $table->string('no_rekam_medis');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_dokter');
            $table->text('keluhan')->nullable();
            $table->enum('cara', ['Online', 'Offline']);
            $table->string('no_antrian');
            $table->enum('status', [0, 1]);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('no_rekam_medis')->references('no_rekam_medis')->on('pasien');
            $table->foreign('id_jadwal')->references('id')->on('jadwal');
            $table->foreign('id_dokter')->references('id')->on('dokter');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->string('no_rekam_medis')->primary();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jk', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('pekerjaan');
            $table->char('gol_darah', 2);
            $table->string('no_telp');
            $table->string('email');
            $table->integer('id_provinsi');
            $table->integer('id_kabupaten');
            $table->integer('id_kecamatan');
            $table->text('alamat');
            $table->text('foto_ktp')->nullable();
            $table->enum('metode_bayar', ['bpjs', 'umum']);
            // Wali
            $table->string('nama_wali')->nullable();
            $table->enum('jk_wali', ['L', 'P'])->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('no_telp_wali')->nullable();
            $table->string('email_wali')->nullable();
            $table->integer('id_provinsi_wali')->nullable();
            $table->integer('id_kabupaten_wali')->nullable();
            $table->integer('id_kecamatan_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            // id user
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

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
        Schema::dropIfExists('pasien');
    }
}

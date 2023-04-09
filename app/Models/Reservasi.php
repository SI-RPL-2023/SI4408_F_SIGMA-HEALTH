<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservasi';
    protected $primary_key = 'kode_reservasi';

    protected $fillable = [
        'kode_reservasi',
        'no_rekam_medis',
        'id_jadwal',
        'id_dokter',
        'keluhan',
        'cara',
        'no_antrian',
        'status',
        'id_user',
        'updated_at',
        'created_at'
    ];
}

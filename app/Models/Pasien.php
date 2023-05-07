<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primary_key = 'no_rekam_medis';
    protected $fillable = [
        'no_rekam_medis',
        'nik',
        'nama',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'pekerjaan',
        'gol_darah',
        'no_telp',
        'email',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'alamat',
        'foto_ktp',
        'nama_wali',
        'jk_wali',
        'pekerjaan_wali',
        'hubungan',
        'no_telp_wali',
        'email_wali',
        'id_provinsi_wali',
        'id_kabupaten_wali',
        'id_kecamatan_wali',
        'alamat_wali',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';

    protected $fillable = [
        'id_dokter',
        'jadwal_mulai',
        'jadwal_selesai',
        'created_at',
        'updated_at'
    ];
}

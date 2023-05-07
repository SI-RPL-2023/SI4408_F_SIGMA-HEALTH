<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';

    protected $fillable = [
        'id_poli',
        'nama',
        'jk',
        'created_at',
        'updated_at'
    ];
}

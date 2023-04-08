<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\Pasien;
use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Reservasi;
use DB;
use Session;
use Carbon\Carbon;
session_id("tubes-wad");
session_start();

class PasienController extends Controller
{
    private function noRekamMedis()
    {
        $kode = "RM-".date('Y').'-';
        $currentKode = date('Y');
        $lastDigit = DB::table('pasien')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(no_rekam_medis, 9, 7)), 0)+1 digit"))
            ->where(DB::raw("SUBSTRING(no_rekam_medis, 4, 4)"), '=', $currentKode)
            ->first();
        $lastDigit = json_decode(json_encode($lastDigit), true);

        $kode .= sprintf("%07s", $lastDigit['digit']);

        return $kode;
    }
    
    public function index()
    {
        $provinces = Province::all();
        $no_rekam_medis = $this->noRekamMedis();
        return view('pages/pendaftaran-pasien', compact('no_rekam_medis', 'provinces'));
    }
}
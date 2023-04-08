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
    private function kodeReservasi()
    {
        $kode = "KR-".date('Y').'-';
        $currentKode = date('Y');
        $lastDigit = DB::table('reservasi')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(kode_reservasi, 9, 7)), 0)+1 digit"))
            ->where(DB::raw("SUBSTRING(kode_reservasi, 4, 4)"), '=', $currentKode)
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

    public function daftar_pasien(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $this->validate($request, [
            'nik' => ['required', 'string', 'max:16', 'unique:pasien'],
            'nama' => ['required', 'string'],
            'jk' => ['required', 'string'],
            'tempat_lahir'  => ['required', 'string'],
            'tgl_lahir'     => ['required', 'string'],
            'pekerjaan'     => ['required', 'string'],
            'gol_darah'     => ['required', 'string'],
            'no_telp'       => ['required', 'string'],
            'email'         => ['required', 'string'],
            'id_provinsi'   => ['required'],
            'id_kabupaten'  => ['required'],
            'id_kecamatan'  => ['required'],
            'alamat'        => ['required', 'string'],
            'foto_ktp'      => 'image|mimes:jpeg,png,jpg',
            'metode_bayar' =>  ['required', 'string'],
        ]);

        // SETUP STORE IMAGE INTO DATABASE
        if($request->hasFile('foto_ktp'))
        {
            $image = $param['foto_ktp'];
            $name = time().rand(1,100).'.'.$image->extension();
            $image->move(public_path('assets/uploads/ktp'), $name);  
            $foto_ktp = $name;

            //store data in your database
            $res = Pasien::create([
                'no_rekam_medis'   => $param['no_rekam_medis'],
                'nik'           => $param['nik'],
                'nama'          => $param['nama'],
                'jk'            => $param['jk'],
                'tempat_lahir'  => $param['tempat_lahir'],
                'tgl_lahir'     => date('Y-m-d', strtotime($param['tgl_lahir'])),
                'pekerjaan'     => $param['pekerjaan'],
                'gol_darah'     => $param['gol_darah'],
                'no_telp'       => $param['no_telp'],
                'email'         => $param['email'],
                'id_provinsi'   => $param['id_provinsi'],
                'id_kabupaten'  => $param['id_kabupaten'],
                'id_kecamatan'  => $param['id_kecamatan'],
                'alamat'        => $param['alamat'],
                'nama_wali'     => $param['nama_wali'],
                'jk_wali'       => $param['jk_wali'],
                'pekerjaan_wali'=> $param['pekerjaan_wali'],
                'hubungan'      => $param['hubungan'],
                'no_telp_wali'  => $param['no_telp_wali'],
                'email_wali'    => $param['email_wali'],
                'id_provinsi_wali'   => $param['id_provinsi_wali'],
                'id_kabupaten_wali'  => $param['id_kabupaten_wali'],
                'id_kecamatan_wali'  => $param['id_kecamatan_wali'],
                'alamat_wali'        => $param['alamat_wali'],
                'foto_ktp'      => $foto_ktp,
                'id_user'       => $param['id_user'],
                'metode_bayar' => $param['metode_bayar'],
            ]);
        } else {
            $res = Pasien::create([
                'no_rekam_medis'   => $param['no_rekam_medis'],
                'nik'           => $param['nik'],
                'nama'          => $param['nama'],
                'jk'            => $param['jk'],
                'tempat_lahir'  => $param['tempat_lahir'],
                'tgl_lahir'     => date('Y-m-d', strtotime($param['tgl_lahir'])),
                'pekerjaan'     => $param['pekerjaan'],
                'gol_darah'     => $param['gol_darah'],
                'no_telp'       => $param['no_telp'],
                'email'         => $param['email'],
                'id_provinsi'   => $param['id_provinsi'],
                'id_kabupaten'  => $param['id_kabupaten'],
                'id_kecamatan'  => $param['id_kecamatan'],
                'alamat'        => $param['alamat'],
                'nama_wali'     => $param['nama_wali'],
                'jk_wali'       => $param['jk_wali'],
                'pekerjaan_wali'=> $param['pekerjaan_wali'],
                'hubungan'      => $param['hubungan'],
                'no_telp_wali'  => $param['no_telp_wali'],
                'email_wali'    => $param['email_wali'],
                'id_provinsi_wali'   => $param['id_provinsi_wali'],
                'id_kabupaten_wali'  => $param['id_kabupaten_wali'],
                'id_kecamatan_wali'  => $param['id_kecamatan_wali'],
                'alamat_wali'        => $param['alamat_wali'],
                'id_user'       => $param['id_user'],
                'metode_bayar' => $param['metode_bayar'],
            ]);
        }        

        if($res)
        {
            $no_rekam_medis = $res->no_rekam_medis;
            $tgl_lahir = $res->tgl_lahir;
            return redirect()->to('pilih-poli?no_rekam_medis='.$no_rekam_medis.'&tgl_lahir='.$tgl_lahir.'');
        } else {
            echo "Error";
        }
    }

    public function getKota()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $regencies = Regency::where('province_id', $id)->select('id', 'name')->get();

            return json_encode($regencies);
        }      
    }

    public function getKecamatan()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $districts = District::where('regency_id', $id)->select('id', 'name')->get();

            return json_encode($districts);
        }
    }

    public function pilih_poli()
    {
        if(isset($_GET['no_rekam_medis']) && isset($_GET['tgl_lahir']))
        {
            $no_rekam_medis = $_GET['no_rekam_medis'];
            $tgl_lahir = date('Y-m-d', strtotime($_GET['tgl_lahir']));

            $cek = DB::table('pasien')->where('no_rekam_medis', '=', $no_rekam_medis)->where('tgl_lahir', '=', $tgl_lahir)->first();

            if($cek)
            {
                $dokter = DB::table('dokter as a')
                         ->join('poli as b', 'a.id_poli', '=', 'b.id')
                         ->select('a.id', 'a.nama as nama_dokter', 'b.nama as nama_poli')
                         ->get();
                return view('pages.form-poli', compact('cek', 'dokter'));
            } else {
                return redirect()->back()->with('error', 'Data pasien tidak ada');
            }
        }
    }

    public function poliklinik()
    {
        $dokter = DB::table('dokter as a')
                    ->join('poli as b', 'a.id_poli', '=', 'b.id')
                    ->join('jadwal as c', 'a.id', '=', 'c.id_dokter')
                    ->select('a.nama as nama_dokter', 'a.jk', 'b.nama as nama_poli', 'c.jadwal_mulai', 'c.jadwal_selesai')
                    ->get();
        return view('pages.poliklinik', compact('dokter'));
    }

    public function getWaktuPeriksa()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $jadwal = DB::table('jadwal')
            ->select('id',
                     DB::raw('DATE_FORMAT(jadwal.jadwal_mulai, "%m/%d/%Y (%H:%i)") as jadwal_mulai'), 
                     DB::raw('DATE_FORMAT(jadwal.jadwal_selesai, "%m/%d/%Y (%H:%i)") as jadwal_selesai'))
            ->where('id_dokter', $id)
            ->get();

            return json_encode($jadwal);
        }      
    }

    public function doReservasi(Request $request)
    {
        // dd();
        $param = $request->all();

        $this->validate($request, [
            'no_rekam_medis' => ['required', 'string'],
            'id_jadwal' => 'required',
            'id_dokter' => 'required',
        ]);
        
        $id_jadwal = $param['id_jadwal'];
        $no_antrian_final = '0';
        $no_antrian = DB::table('reservasi')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(no_antrian, 1, 4)), 0)+1 digit"))
            ->where('id_jadwal', $id_jadwal)
            ->first();

        $no_antrian = json_decode(json_encode($no_antrian), true);

        $no_antrian_final .= sprintf("%03s", $no_antrian['digit']);
        // dd($no_antrian_final);

        $res = Reservasi::create([
            'kode_reservasi' => $this->kodeReservasi(),
            'no_rekam_medis' => $param['no_rekam_medis'],
            'id_jadwal' => $param['id_jadwal'],
            'id_dokter' => $param['id_dokter'],
            'keluhan' => $param['keluhan'],
            'cara' => 'Online',
            'no_antrian' => $no_antrian_final,
            'status' => '0',
            'id_user' => Session::get('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if($res)
        {
            return redirect()->to('pendaftaran-pasien')->with('res_success', 'Reservasi berhasil dibuat');
        } else {
            return redirect()->to('pendaftaran-pasien')->with('error', 'Reservasi gagal dibuat');
        }
    }

    public function form_reservasi()
    {
        return view('pages.cek-reservasi');
    }

    public function hasil_reservasi()
    {
        if(isset($_GET['no_rekam_medis']) && isset($_GET['tgl_lahir']))
        {
            $no_rekam_medis = $_GET['no_rekam_medis'];
            $tgl_lahir = date('Y-m-d', strtotime($_GET['tgl_lahir']));

            $cek = DB::table('reservasi as a')
            ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
            ->select('a.*', 'b.tgl_lahir')
            ->where('a.no_rekam_medis', '=', $no_rekam_medis)
            ->where('b.tgl_lahir', '=', $tgl_lahir)
            ->first();

            if($cek)
            {
                $res = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->select('a.*', 'b.tgl_lahir')
                ->where('a.no_rekam_medis', '=', $no_rekam_medis)
                ->where('b.tgl_lahir', '=', $tgl_lahir)
                ->get();

                return view('pages.hasil-reservasi', compact('cek', 'res'));
            } else {
                return redirect()->back()->with('error', 'Data reservasi tidak ada');
            }
        }
    }

    public function tampil_hasil_reservasi($id)
    {
        $cek = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->join('jadwal as c', 'a.id_jadwal', '=', 'c.id')
                ->join('dokter as d', 'a.id_dokter', '=', 'd.id')
                ->join('poli as e', 'd.id_poli', '=', 'e.id')
                ->select('a.*', 'b.nama as nama_pasien', 
                'b.no_telp', 'b.alamat',
                'c.jadwal_mulai','c.jadwal_selesai',
                'd.nama as nama_dokter',
                'e.nama as nama_poli')
                ->where('a.kode_reservasi', $id)
                ->first();
        
        if($cek)
        {
            return view('pages.tampil-hasil-reservasi', compact('cek'));
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function cetak_reservasi($id)
    {
        $cek = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->join('jadwal as c', 'a.id_jadwal', '=', 'c.id')
                ->join('dokter as d', 'a.id_dokter', '=', 'd.id')
                ->join('poli as e', 'd.id_poli', '=', 'e.id')
                ->select('a.*', 'b.nama as nama_pasien', 
                'b.no_telp', 'b.alamat',
                'c.jadwal_mulai','c.jadwal_selesai',
                'd.nama as nama_dokter',
                'e.nama as nama_poli')
                ->where('a.kode_reservasi', $id)
                ->first();
        
        if($cek)
        {
            if($cek->status == '0')
            {
                return redirect()->back()->with('error', 'Akses dilarang');      
            } else if($cek->status == '1') {
                return view('pages.cetak-reservasi', compact('cek'));
            }       
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function form_cek_obat()
    {
        return view('pages.cek-obat');
    }

    public function hasil_obat()
    {
        if(isset($_GET['no_rekam_medis']) && isset($_GET['tgl_lahir']))
        {
            $no_rekam_medis = $_GET['no_rekam_medis'];
            $tgl_lahir = date('Y-m-d', strtotime($_GET['tgl_lahir']));

            $cek = DB::table('reservasi as a')
            ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
            ->join('obat as c', 'a.kode_reservasi', '=', 'c.kode_reservasi')
            ->select('a.*', 'b.tgl_lahir')
            ->where('a.no_rekam_medis', '=', $no_rekam_medis)
            ->where('b.tgl_lahir', '=', $tgl_lahir)
            ->first();

            if($cek)
            {
                $res = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->join('obat as c', 'a.kode_reservasi', '=', 'c.kode_reservasi')
                ->select('c.*', 'b.nama', 'b.tgl_lahir')
                ->where('a.no_rekam_medis', '=', $no_rekam_medis)
                ->where('b.tgl_lahir', '=', $tgl_lahir)
                ->get();

                return view('pages.hasil-obat', compact('cek', 'res'));
            } else {
                return redirect()->back()->with('error', 'Data obat untuk pasien tidak ada');
            }
        }
    }

    public function tampil_hasil_obat($id)
    {
        $cek = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->join('jadwal as c', 'a.id_jadwal', '=', 'c.id')
                ->join('dokter as d', 'a.id_dokter', '=', 'd.id')
                ->join('poli as e', 'd.id_poli', '=', 'e.id')
                ->join('obat as f', 'a.kode_reservasi', '=', 'f.kode_reservasi')
                ->select('a.*', 'b.nama as nama_pasien', 
                'b.no_telp', 'b.alamat',
                'c.jadwal_mulai','c.jadwal_selesai',
                'd.nama as nama_dokter',
                'e.nama as nama_poli',
                'f.obat', 'f.id')
                ->where('f.id', $id)
                ->first();
        
        if($cek)
        {
            return view('pages.tampil-hasil-obat', compact('cek'));
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function cetak_obat($id)
    {
        $cek = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->join('jadwal as c', 'a.id_jadwal', '=', 'c.id')
                ->join('dokter as d', 'a.id_dokter', '=', 'd.id')
                ->join('poli as e', 'd.id_poli', '=', 'e.id')
                ->join('obat as f', 'a.kode_reservasi', '=', 'f.kode_reservasi')
                ->select('a.*', 'b.nama as nama_pasien', 
                'b.no_telp', 'b.alamat',
                'c.jadwal_mulai','c.jadwal_selesai',
                'd.nama as nama_dokter',
                'e.nama as nama_poli',
                'f.obat', 'f.id')
                ->where('f.id', $id)
                ->first();
        
        if($cek)
        {
            if($cek->status == '0')
            {
                return redirect()->back()->with('error', 'Akses dilarang');      
            } else if($cek->status == '1') {
                return view('pages.cetak-obat', compact('cek'));
            }       
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }
}
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
use App\Models\Obat;
use DB;
use Session;
use Carbon\Carbon;
session_id("tubes-wad");
session_start();

class AdminController extends Controller
{
    public function cek_reservasi_pasien()
    {
       $reservasi = DB::table('reservasi as a')
            ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
            ->join('jadwal as c', 'a.id_jadwal', '=', 'c.id')
            ->join('dokter as d', 'a.id_dokter', '=', 'd.id')
            ->join('poli as e', 'd.id_poli', '=', 'e.id')
            ->select('a.*', 'b.nama as nama_pasien', 
            'b.no_telp', 'b.alamat',
            'c.jadwal_mulai','c.jadwal_selesai',
            'd.nama as nama_dokter',
            'e.nama as nama_poli')
            ->orderBy('id_dokter', 'asc')
            ->get();

        return view('pages.admin.cek-reservasi-pasien', compact('reservasi'));
    }

    public function ubah_status(Request $request, $id)
    {
        $res = Reservasi::where('kode_reservasi', $id)->update([
            'status' => '1'
        ]);

        if($res)
        {
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Data gagal diubah');
        }
    }

    public function master_poli()
    {
        $poli = Poli::get();
        return view('pages.admin.master-poli', compact('poli'));
    }

    public function master_poli_simpan(Request $request)
    {
        $param = $request->all();
        $this->validate($request, [
            'nama' => ['required', 'string']
        ]);

        $res = Poli::create([
            'nama' => $param['nama'],
        ]);

        if($res)
        {
            return redirect()->to('master-poli')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->to('master-poli')->with('error', 'Data gagal disimpan');   
        }
    }

    public function master_poli_update(Request $request, $id)
    {
        $param = $request->all();
        $this->validate($request, [
            'nama' => ['required', 'string']
        ]);

        $cek = Poli::findOrFail($id);

        if($cek)
        {
            $res = Poli::where('id', $id)->update([
                'nama' => $param['nama'],
            ]);
    
            if($res)
            {
                return redirect()->to('master-poli')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->to('master-poli')->with('error', 'Data gagal diubah');   
            }
        }
    }

    public function master_poli_delete($id)
    {
        $cek = Poli::findOrFail($id);
        if($cek)
        {
            $cek->delete();
            return redirect()->to('master-poli')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('master-poli')->with('error', 'Data gagal dihapus');   
        }
    }

    public function master_dokter()
    {
        $dokter = DB::table('dokter as a')
                ->join('poli as b', 'a.id_poli', '=', 'b.id')
                ->select('a.*', 'b.nama as nama_poli')
                ->orderBy('a.id', 'asc')
                ->get();
        $poli = Poli::get();
        return view('pages.admin.master-dokter', compact('dokter', 'poli'));
    }

    public function master_dokter_simpan(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $this->validate($request, [
            'nama' => ['required', 'string'],
            'id_poli' => 'required',
            'jk' => 'required'
        ]);

        $res = Dokter::create([
            'nama' => $param['nama'],
            'id_poli' => $param['id_poli'],
            'jk' => $param['jk']
        ]);

        if($res)
        {
            return redirect()->to('master-dokter')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->to('master-dokter')->with('error', 'Data gagal disimpan');   
        }
    }

    public function master_dokter_update(Request $request, $id)
    {
        $param = $request->all();
        $this->validate($request, [
            'nama' => ['required', 'string'],
            'id_poli' => ['required'],
            'jk' => ['required']
        ]);

        $cek = Dokter::findOrFail($id);

        if($cek)
        {
            $res = Dokter::where('id', $id)->update([
                'nama' => $param['nama'],
                'id_poli' =>$param['id_poli'],
                'jk' => $param['jk']
            ]);
    
            if($res)
            {
                return redirect()->to('master-dokter')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->to('master-dokter')->with('error', 'Data gagal diubah');   
            }
        }
    }

    public function master_dokter_delete($id)
    {
        $cek = Dokter::findOrFail($id);
        if($cek)
        {
            $cek->delete();
            return redirect()->to('master-dokter')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('master-dokter')->with('error', 'Data gagal dihapus');   
        }
    }

    public function master_jadwal()
    {
        $jadwal = DB::table('jadwal as a')
                ->join('dokter as b', 'a.id_dokter', '=', 'b.id')
                ->select('a.*', 'b.nama as nama_dokter')
                ->orderBy('a.id', 'asc')
                ->get();

        $dokter = Dokter::get();
        return view('pages.admin.master-jadwal', compact('jadwal', 'dokter'));
    }

    public function master_jadwal_simpan(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $this->validate($request, [
            'id_dokter' => ['required'],
            'jadwal_mulai' => ['required', 'string'],
            'jadwal_selesai' => ['required', 'string'],
        ]);

        $jadwal_mulai = date('Y-m-d H:i', strtotime($param['jadwal_mulai']));
        $jadwal_selesai = date('Y-m-d H:i', strtotime($param['jadwal_selesai']));

        $res = Jadwal::create([
            'id_dokter' => $param['id_dokter'],
            'jadwal_mulai' => $jadwal_mulai,
            'jadwal_selesai' => $jadwal_selesai,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if($res)
        {
            return redirect()->to('master-jadwal')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->to('master-jadwal')->with('error', 'Data gagal disimpan');   
        }
    }

    public function master_jadwal_update(Request $request, $id)
    {
        $param = $request->all();

        $this->validate($request, [
            'id_dokter' => ['required'],
            'jadwal_mulai_edit' => ['required', 'string'],
            'jadwal_selesai_edit' => ['required', 'string'],
        ]);

        $cek = Jadwal::findOrFail($id);

        if($cek)
        {           
            $jadwal_mulai = date('Y-m-d H:i', strtotime($param['jadwal_mulai_edit']));
            $jadwal_selesai = date('Y-m-d H:i', strtotime($param['jadwal_selesai_edit']));

            $res = Jadwal::where('id', $id)->update([
                'id_dokter' => $param['id_dokter'],
                'jadwal_mulai' => $jadwal_mulai,
                'jadwal_selesai' => $jadwal_selesai,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    
            if($res)
            {
                return redirect()->to('master-jadwal')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->to('master-jadwal')->with('error', 'Data gagal diubah');   
            }
        }
    }

    public function master_jadwal_delete($id)
    {
        $cek = Jadwal::findOrFail($id);
        if($cek)
        {
            $cek->delete();
            return redirect()->to('master-jadwal')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('master-jadwal')->with('error', 'Data gagal dihapus');   
        }
    }
    
    public function home()
    {
        return view('pages.admin.home');
    }

    public function master_obat()
    {
        $pasien = DB::table('reservasi as a')
                ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
                ->select('a.kode_reservasi', 'a.no_rekam_medis', 'b.nama', 'b.no_telp', 'b.alamat')
                ->get();
        $obat = DB::table('obat as a')
            ->join('pasien as b', 'a.no_rekam_medis', '=', 'b.no_rekam_medis')
            ->select('a.*', 'b.nama', 'b.no_telp', 'b.alamat')
            ->get();

        return view('pages.admin.master-obat', compact('pasien', 'obat'));
    }

    public function master_obat_simpan(Request $request)
    {
        $param = $request->all();
        $this->validate($request, [
            'kode_reservasi' => ['required', 'string'],
            'no_rekam_medis' => ['required', 'string'],
            'obat' => ['required', 'string']
        ]);

        $res = Obat::create([
            'kode_reservasi' => $param['kode_reservasi'],
            'no_rekam_medis' => $param['no_rekam_medis'],
            'obat' => $param['obat']
        ]);

        if($res)
        {
            return redirect()->to('master-obat')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->to('master-obat')->with('error', 'Data gagal disimpan');   
        }
    }

    public function master_obat_update(Request $request, $id)
    {
        $param = $request->all();
        $this->validate($request, [
<<<<<<< HEAD
            'kode_reservasi' => ['required', 'string', 'unique:reservasi'],
=======
            'kode_reservasi' => ['required', 'string'],
>>>>>>> origin/daniel
            'no_rekam_medis' => ['required', 'string'],
            'obat' => ['required', 'string']
        ]);

        $cek = Obat::findOrFail($id);

        if($cek)
        {
            $res = Obat::where('id', $id)->update([
                'obat' => $param['obat']
            ]);
    
            if($res)
            {
                return redirect()->to('master-obat')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->to('master-obat')->with('error', 'Data gagal diubah');   
            }
        }
    }

    public function master_obat_delete($id)
    {
        $cek = Obat::findOrFail($id);
        if($cek)
        {
            $cek->delete();
            return redirect()->to('master-obat')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('master-obat')->with('error', 'Data gagal dihapus');   
        }
    }
}
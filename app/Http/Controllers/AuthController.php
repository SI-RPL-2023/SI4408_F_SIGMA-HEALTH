<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\RateLimiter;

use App\Models\User;
use Session;

session_id("tubes-wad");
session_start();

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('pages/register');
    }

    public function doRegister(Request $request)
    {
        $param = $request->all();
        $user = Auth::user();

        $this->validate($request, [
            'nama'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 
                            'string', 
                            'min:8'],
            'konfirmasi_password' => ['required', 'string']
        ]);

        if($param['konfirmasi_password'] == $param['password'])
        {
            $register = User::create([
                'nama' => $param['nama'],
                'email' => $param['email'],
                'role' => 'pasien',
                'password' => Hash::make($param['password']),
                'created_at' => date('Y-m-d H:i:s')         
            ]);
    
            if($register)
            {
                return redirect()->to('login')->with('success', 'Registrasi akun berhasil');
            } else {
                return redirect()->to('login')->with('error', 'Registrasi akun gagal');
            }
        } else {
            return redirect()->to('login')->with('error', 'Registrasi akun gagal! Password tidak sama');
        }
    }

    public function showLogin()
    {
        return view('pages/login');
    }

    public function doLogin(Request $request)
    {
        if (RateLimiter::tooManyAttempts(request()->ip(), 3)) {
            return back()->with('error', 'Silahkan coba lagi dalam 1 menit');
        }

        // Validate form
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $param = $request->only(['email', 'password']);
        // select credentials to login
        $result = User::where('email', $param['email'])->first();

        if($result)
        {                   
            if(Hash::check($param['password'], $result['password']))
            {
                RateLimiter::clear(request()->ip());
                if(Auth::attempt($param))
                {
                    $user = Auth::user();
                    // SET SESSION
                    Session::put('login', true);
                    Session::put('id_user', $result['id']);
                    Session::put('nama', $result['nama']);
                    Session::put('password', $param['password']);
                    Session::put('role', $result['role']);
                    // END OF SESSION

                    if(isset($request->remember))
                    {
                        // SET COOKIE
                        Cookie::queue('remember', 'remembered', 120);
                        Cookie::queue('id_user', $result['id'], 120);
                        Cookie::queue('email', $result['email'], 120);
                        Cookie::queue('password', $param['password'], 120);
                    }

                    // Redirect pages
                    if(Session::get('role') == 'pasien')
                    {
                        return Redirect::to('pendaftaran-pasien');
                    } else if(Session::get('role') == 'admin')
                    {
                        return Redirect::to('home-admin');
                    }
                }
            } else {
                RateLimiter::hit(request()->ip(), 60);
                if (RateLimiter::tooManyAttempts(request()->ip(), 3)) {
                    return back()->with('error', 'Silahkan coba lagi dalam 1 menit');
                }
                return back()->with('error', 'Password salah!');
            }
        } else {
            RateLimiter::hit(request()->ip(), 60);
            return back()->with('error', 'Email salah!');
        }
    }

    public function doLogout()
    {
        Session::flush();
        if(Cookie::has('remember') == true)
        {
            Cookie::queue(Cookie::forget('remember'));
            Cookie::queue(Cookie::forget('user_id'));
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }
        return Redirect::to('/login');
    }
}
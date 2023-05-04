<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Illuminate\Support\Facades\Hash;
use App\Models\M_Auth;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Support\Facades\Mail;

class C_Login extends Controller
{

    private $M_Auth;
    private $M_Website;
    private $M_User;

    public function __construct()
    {
        $this->M_Auth = new M_Auth();
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
    }

    public function index()
    {
        $this->validasi_role();

        $data = [
            'title'     => 'Login',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_login', $data);
    }

    public function login()
    {
        $this->validasi_role();

        Request()->validate([
            'email'             => 'required|email',
            'password'          => 'min:6|required',
        ], [
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minimal 6 karakter!',
        ]);

        $cek_email = $this->M_Auth->cek_email_user(Request()->email);

        if ($cek_email) {
            if ($cek_email->role === "Admin") {
                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_admin');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cek_email->role === "Donatur") {

                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_donatur');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cek_email->role === "Event") {

                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_event');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cek_email->role === "Petugas Kesehatan") {

                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_petugas_kesehatan');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cek_email->role === "Rumah Sakit") {

                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_rumah_sakit');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cek_email->role === "Pusat PMI") {

                if (Hash::check(Request()->password, $cek_email->password)) {
                    Session()->put('id_user', $cek_email->id_user);
                    Session()->put('email', $cek_email->email);
                    Session()->put('role', $cek_email->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboard_pusat_pmi');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            }
        } else {
            return back()->with('gagal', 'Email belum terdaftar.');
        }
    }

    public function logout()
    {
        Session()->forget('id_user');
        Session()->forget('email');
        Session()->forget('role');
        Session()->forget('log');
        return redirect()->route('login')->with('berhasil', 'Logout berhasil!');
    }

    public function validasi_role()
    {
        if (Session()->get('email')) {
            if (Session()->get('role') === 'Admin') {
                return redirect()->route('dashboard_admin');
            } elseif (Session()->get('role') === 'Donatur') {
                return redirect()->route('dashboard_donatur');
            } elseif (Session()->get('role') === 'Event') {
                return redirect()->route('dashboard_event');
            } elseif (Session()->get('role') === 'Petugas Kesehatan') {
                return redirect()->route('dashboard_petugas_kesehatan');
            } elseif (Session()->get('role') === 'Rumah Sakit') {
                return redirect()->route('dashboard_rumah_sakit');
            } elseif (Session()->get('role') === 'Pusat PMI') {
                return redirect()->route('dashboard_pusat_pmi');
            }
        }
    }
}

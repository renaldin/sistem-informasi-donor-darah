<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Illuminate\Support\Facades\Hash;
use App\Models\M_Auth;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Support\Facades\Mail;

class C_Register extends Controller
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
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Register',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_register', $data);
    }

    public function register()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|unique:user,email|email',
            'password'          => 'min:6|required',
            'role'              => 'required',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minimal 6 karakter!',
            'role.required'             => 'Role harus diisi!',
        ]);

        $data = [
            'nama'              => Request()->nama,
            'nomor_telepon'     => Request()->nomor_telepon,
            'email'             => Request()->email,
            'password'          => Hash::make(Request()->password),
            'role'              => Request()->role,
        ];

        $this->M_User->tambah($data);
        return redirect()->route('login')->with('berhasil', 'Register berhasil!');
    }
}

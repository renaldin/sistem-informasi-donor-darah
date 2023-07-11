<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Illuminate\Support\Facades\Hash;
use App\Models\M_Auth;
use App\Models\M_User;
use App\Models\M_Website;
use DateTime;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
            'register'  => 'Pilihan',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_register', $data);
    }

    public function register_donatur()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Register',
            'register'  => 'Donatur',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_register', $data);
    }

    public function register_event()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Register',
            'register'  => 'Event',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_register', $data);
    }

    public function register_rumah_sakit()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Register',
            'register'  => 'Rumah Sakit',
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
            'alamat_user'       => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|unique:user,email|email',
            'password'          => 'min:6|required',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'alamat_user.required'      => 'Alamat harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minimal 6 karakter!',
        ]);

        if (Request()->role === 'Donatur') {
            Request()->validate([
                'nik'               => 'required|min:16|max:16',
                'tanggal_lahir'     => 'required|date',
                'jk'                => 'required',
            ], [
                'nik.required'              => 'NIK harus diisi!',
                // 'nik.numeric'               => 'NIK harus angka!',
                'nik.min'               => 'NIK harus 16 karakter!',
                'nik.max'               => 'NIK harus 16 karakter!',
                'tanggal_lahir.required'    => 'Tanggal lahir harus diisi!',
                'tanggal_lahir.date'        => 'Tanggal lahir berupa tanggal!',
                'jk.required'               => 'Jenis kelamin harus diisi!',
            ]);

            $tanggal_lahir = new DateTime(Request()->tanggal_lahir);
            $sekarang = new DateTime();
            $selisih = $sekarang->diff($tanggal_lahir);
            $umur = $selisih->y;

            if ($umur < 17) {
                Alert::error('Gagal', "Tidak bisa lanjut daftar. Umur Anda kurang dari 17 tahun!");
                return redirect()->route('register_donatur');
            }
        } elseif (Request()->role === 'Event') {
            Request()->validate([
                'kode_instansi' => 'required',
            ], [
                'kode_instansi.required'    => 'Kode instansi harus diisi!',
            ]);
        } elseif (Request()->role === 'Rumah Sakit') {
            Request()->validate([
                'kode_rs' => 'required',
            ], [
                'kode_rs.required'    => 'Kode rumah sakit harus diisi!',
            ]);
        }

        $data = [
            'nama'              => Request()->nama,
            'alamat_user'       => Request()->alamat_user,
            'nomor_telepon'     => Request()->nomor_telepon,
            'email'             => Request()->email,
            'role'              => Request()->role,
            'password'          => Hash::make(Request()->password),
        ];
        $this->M_User->tambah($data);
        $data_terakhir = $this->M_User->last_data();

        if (Request()->role === 'Donatur') {
            $data_donatur = [
                'id_user'       => $data_terakhir->id_user,
                'nik'           => Request()->nik,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'jk'            => Request()->jk,
                'gol_darah'     => Request()->gol_darah,
            ];

            $this->M_User->tambah_donatur($data_donatur);
        } elseif (Request()->role === 'Event') {
            $data_event = [
                'id_user'       => $data_terakhir->id_user,
                'kode_instansi' => Request()->kode_instansi,
            ];

            $this->M_User->tambah_event($data_event);
        } elseif (Request()->role === 'Rumah Sakit') {
            $data_rs = [
                'id_user'       => $data_terakhir->id_user,
                'kode_rs'       => Request()->kode_rs,
            ];

            $this->M_User->tambah_rumah_sakit($data_rs);
        }

        $data_email = [
            'subject'       => 'Verifikasi Akun',
            'sender_name'   => 'purbateresia2@gmail.com',
            'urlUtama'      => 'http://127.0.0.1:8000',
            'tipe'          => 'Verifikasi',
            'urlReset'      => 'http://127.0.0.1:8000/verifikasi/' . $data_terakhir->id_user,
            'dataUser'      => $data_terakhir,
            'biodata'       => $this->M_Website->detail(1),
        ];

        Mail::to($data_terakhir->email)->send(new kirimEmail($data_email));

        Alert::success('Berhasil', "Register berhasil. Silahkan cek email untuk verifikasi!");
        return redirect()->route('login');
    }

    public function verifikasi($id_user)
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $detail = $this->M_User->detail($id_user);

        $data = [
            'id_user'           => $id_user,
            'status_verifikasi'  => 'Sudah'
        ];

        $this->M_User->edit($data);
        return redirect()->route('login')->with('berhasil', 'Anda berhasil verifikasi akun. Silahkan login!');
    }
}

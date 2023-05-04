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
        if (Session()->get('email')) {
            if (Session()->get('role') === 'Admin') {
                return redirect()->route('dashboardAdmin');
            } elseif (Session()->get('role') === 'Pegawai') {
                return redirect()->route('dashboardPegawai');
            }
        }

        $data = [
            'title' => 'Login',
            'biodata'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_login', $data);
    }

    public function login()
    {
        Request()->validate([
            'email'             => 'required|email',
            'password'          => 'min:6|required',
        ], [
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minimal 6 karakter!',
        ]);

        $cekEmail = $this->M_Auth->cekEmailUser(Request()->email);

        if ($cekEmail) {
            if ($cekEmail->role === "Pegawai") {
                if (Hash::check(Request()->password, $cekEmail->password)) {
                    Session()->put('id_user', $cekEmail->id_user);
                    Session()->put('email', $cekEmail->email);
                    Session()->put('role', $cekEmail->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboardPegawai');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cekEmail->role === "Admin") {

                if (Hash::check(Request()->password, $cekEmail->password)) {
                    Session()->put('id_user', $cekEmail->id_user);
                    Session()->put('email', $cekEmail->email);
                    Session()->put('role', $cekEmail->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboardAdmin');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cekEmail->role === "Wakil Direktur") {

                if (Hash::check(Request()->password, $cekEmail->password)) {
                    Session()->put('id_user', $cekEmail->id_user);
                    Session()->put('email', $cekEmail->email);
                    Session()->put('role', $cekEmail->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboardWadir');
                } else {
                    return back()->with('gagal', 'Password tidak sesuai.');
                }
            } else if ($cekEmail->role === "Ketua Jurusan") {

                if (Hash::check(Request()->password, $cekEmail->password)) {
                    Session()->put('id_user', $cekEmail->id_user);
                    Session()->put('email', $cekEmail->email);
                    Session()->put('role', $cekEmail->role);
                    Session()->put('log', true);

                    return redirect()->route('dashboardKajur');
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

    public function lupaPassword()
    {
        if (Session()->get('email')) {
            if (Session()->get('status') === 'User') {
                return redirect()->route('home');
            } else {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title' => 'Lupa Password',
            'biodata'  => $this->M_Website->detail(1),
        ];

        return view('auth.lupaPassword', $data);
    }

    public function lupaPasswordAdmin()
    {
        if (Session()->get('email')) {
            if (Session()->get('status') === 'User') {
                return redirect()->route('home');
            } else {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title' => 'Lupa Password',
            'biodata'  => $this->M_Website->detail(1),
        ];

        return view('auth.lupaPasswordAdmin', $data);
    }

    public function resetPassword($id_member)
    {
        if (Session()->get('email')) {
            if (Session()->get('status') === 'User') {
                return redirect()->route('home');
            } else {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Reset Password',
            'dataUser'  => $this->M_User->detail($id_member),
            'biodata'   => $this->M_Website->detail(1),
        ];

        return view('auth.resetPassword', $data);
    }

    public function resetPasswordAdmin($id_admin)
    {
        if (Session()->get('email')) {
            if (Session()->get('status') === 'User') {
                return redirect()->route('home');
            } else {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Reset Password',
            'dataUser'  => $this->ModelAdmin->detail($id_admin),
            'biodata'   => $this->M_Website->detail(1),
        ];

        return view('auth.resetPasswordAdmin', $data);
    }

    public function prosesEmailLupaPassword()
    {
        $email = Request()->email;
        $status = Request()->status;

        if ($status === 'User') {
            $data = $this->M_User->detailByEmail($email);

            if ($data) {

                $data_email = [
                    'subject'       => 'Lupa Password',
                    'sender_name'   => 'renaldinoviandi1@gmail.com',
                    'urlUtama'      => 'http://127.0.0.1:8000',
                    'urlReset'      => 'http://127.0.0.1:8000/reset-password/' . $data->id_member,
                    'dataUser'      => $data,
                    'biodata'       => $this->M_Website->detail(1),
                ];

                Mail::to($data->email)->send(new kirimEmail($data_email));
                return redirect()->route('login')->with('berhasil', 'Kami sudah kirim pesan ke email Anda. Silahkan cek email Anda!');
            } else {
                return back()->with('gagal', 'Email belum terdaftar. Silahkan daftar terlebih dahulu!');
            }
        } elseif ($status === 'Admin') {
            $data = $this->ModelAdmin->detailByEmail($email);

            if ($data) {

                $data_email = [
                    'subject'       => 'Lupa Password',
                    'sender_name'   => 'renaldinoviandi1@gmail.com',
                    'urlUtama'      => 'http://127.0.0.1:8000',
                    'urlReset'      => 'http://127.0.0.1:8000/reset-password-admin/' . $data->id_admin,
                    'dataUser'      => $data,
                    'biodata'       => $this->M_Website->detail(1),
                ];

                Mail::to($data->email)->send(new kirimEmail($data_email));
                return redirect()->route('admin')->with('berhasil', 'Kami sudah kirim pesan ke email Anda. Silahkan cek email Anda!');
            } else {
                return back()->with('gagal', 'Email belum terdaftar. Silahkan daftar terlebih dahulu!');
            }
        }
    }

    public function prosesUbahPassword()
    {
        Request()->validate([
            'password' => 'min:6|required|confirmed',
        ], [
            'password.required'    => 'Password baru harus diisi!',
            'password.min'         => 'Password baru minimal 6 karakter!',
            'password.confirmed'   => 'Password baru tidak sama!',
        ]);

        $data = [
            'id_member'         => Request()->id_member,
            'password'          => Hash::make(Request()->password)
        ];

        $this->M_User->edit($data);
        return redirect()->route('login')->with('berhasil', 'Anda baru saja merubah password. Silahkan login!');
    }

    public function prosesUbahPasswordAdmin()
    {
        Request()->validate([
            'password' => 'min:6|required|confirmed',
        ], [
            'password.required'    => 'Password baru harus diisi!',
            'password.min'         => 'Password baru minimal 6 karakter!',
            'password.confirmed'   => 'Password baru tidak sama!',
        ]);

        $data = [
            'id_admin'         => Request()->id_admin,
            'password'          => Hash::make(Request()->password)
        ];

        $this->ModelAdmin->edit($data);
        return redirect()->route('admin')->with('berhasil', 'Anda baru saja merubah password. Silahkan login!');
    }
}

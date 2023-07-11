<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Illuminate\Support\Facades\Hash;
use App\Models\M_Auth;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Login',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_login', $data);
    }

    public function login()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

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
            if ($cek_email->status_verifikasi === 'Belum') {
                Alert::error('Gagal', "Akun Anda belum verifikasi. Silahkan cek email untuk verifikasi!");
                return back();
            } else {
                if ($cek_email->role) {
                    if (Hash::check(Request()->password, $cek_email->password)) {
                        Session()->put('id_user', $cek_email->id_user);
                        Session()->put('email', $cek_email->email);
                        Session()->put('role', $cek_email->role);
                        Session()->put('log', true);

                        return redirect()->route('dashboard');
                    } else {
                        Alert::error('Gagal', "Password tidak sesuai");
                        return back();
                    }
                }
            }
        } else {
            Alert::error('Gagal', "Email belum terdaftar.");
            return back();
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

    public function lupa_password()
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Lupa Password',
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_lupa_password', $data);
    }

    public function proses_lupa_password()
    {
        $email = Request()->email;

        $data = $this->M_User->detail_email($email);

        if ($data) {

            $data_email = [
                'subject'       => 'Lupa Password',
                'sender_name'   => 'purbateresia2@gmail.com',
                'urlUtama'      => 'http://127.0.0.1:8000',
                'tipe'          => 'Lupa Password',
                'urlReset'      => 'http://127.0.0.1:8000/reset_password/' . $data->id_user,
                'dataUser'      => $data,
                'biodata'       => $this->M_Website->detail(1),
            ];

            Mail::to($data->email)->send(new kirimEmail($data_email));
            return redirect()->route('login')->with('berhasil', 'Kami sudah kirim pesan ke email Anda. Silahkan cek!');
        } else {
            return back()->with('gagal', 'Email belum terdaftar. Silahkan hubungi Admin terlebih dahulu!');
        }
    }

    public function reset_password($id_user)
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        $data = [
            'title'     => 'Reset Password',
            'detail'    => $this->M_User->detail($id_user),
            'data_web'  => $this->M_Website->detail(1),
        ];

        return view('auth.v_reset_password', $data);
    }

    public function proses_reset_password($id_user)
    {
        if (Session()->get('email')) {
            if (Session()->get('role')) {
                return redirect()->route('dashboard');
            }
        }

        Request()->validate([
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'min:6|required',
        ], [
            'password.required'    => 'Password baru harus diisi!',
            'password.min'         => 'Password baru minimal 6 karakter!',
            'password.confirmed'   => 'Password baru tidak sama!',
            'password_confirmation.required'    => 'Konfimrasi Password harus diisi!',
            'password_confirmation.min'         => 'Konfimrasi Password minimal 6 karakter!',
        ]);

        $data = [
            'id_user'       => $id_user,
            'password'      => Hash::make(Request()->password)
        ];

        $this->M_User->edit($data);
        return redirect()->route('login')->with('berhasil', 'Anda baru saja merubah password. Silahkan login!');
    }
}

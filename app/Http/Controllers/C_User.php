<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\M_User;
use App\Models\M_Website;
use RealRashid\SweetAlert\Facades\Alert;
use Twilio\Rest\Client;

class C_User extends Controller
{

    private $M_User;
    private $M_Website;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data User',
            'sub_title'     => 'Data User',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_user'     => $this->M_User->get_data()
        ];

        return view('admin.user.v_index', $data);
    }

    public function tambah_user()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Tambah User',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_tambah', $data);
    }

    public function proses_tambah_user()
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|unique:user,email|email',
            'password'          => 'min:6|required',
            'role'              => 'required',
            'foto'              => 'required|mimes:jpeg,png,jpg|max:2048',
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
            'foto.required'             => 'Foto Anda harus diisi!',
            'foto.mimes'                => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto.max'                  => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        $file1 = Request()->foto;
        $fileUser = date('mdYHis') . Request()->nama . '.' . $file1->extension();
        $file1->move(public_path('foto_user'), $fileUser);

        $data = [
            'nama'              => Request()->nama,
            'nomor_telepon'     => Request()->nomor_telepon,
            'email'             => Request()->email,
            'password'          => Hash::make(Request()->password),
            'role'              => Request()->role,
            'foto'              => $fileUser,
        ];

        $this->M_User->tambah($data);
        Alert::success('Berhasil', 'Data user berhasil ditambah.');
        return redirect()->route('data_user');
    }

    public function edit_user($id_user)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Edit User',
            'data_web'  => $this->M_Website->detail(1),
            'detail'    => $this->M_User->detail($id_user),
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_edit', $data);
    }

    public function proses_edit_user($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|email',
            'role'              => 'required',
            'foto'              => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'role.required'             => 'Role harus diisi!',
            'foto.mimes'                => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto.max'                  => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Request()->password) {

            $user = $this->M_User->detail($id_user);

            if (Request()->foto <> "") {
                if ($user->foto <> "") {
                    unlink(public_path('foto_user') . '/' . $user->foto);
                }

                $file = Request()->foto;
                $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
                $file->move(public_path('foto_user'), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'password'          => Hash::make(Request()->password),
                    'role'              => Request()->role,
                    'foto '             => $fileUser,
                ];
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'password'          => Hash::make(Request()->password),
                    'role'              => Request()->role,
                ];
            }
        } else {
            $user = $this->M_User->detail($id_user);

            if (Request()->foto <> "") {
                if ($user->foto <> "") {
                    unlink(public_path('foto_user') . '/' . $user->foto);
                }

                $file = Request()->foto;
                $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
                $file->move(public_path('foto_user'), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'role'              => Request()->role,
                    'foto'              => $fileUser,
                ];
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'role'              => Request()->role,
                ];
            }
        }

        $this->M_User->edit($data);
        Alert::success('Berhasil', 'Data stok darah berhasil diedit.');
        return redirect()->route('data_user');
    }

    public function hapus_user($id_user)
    {
        $user = $this->M_User->detail($id_user);

        if ($user->foto <> "") {
            unlink(public_path('foto_user') . '/' . $user->foto);
        }

        $this->M_User->hapus($id_user);
        Alert::success('Berhasil', 'Data user berhasil dihapus.');
        return redirect()->route('data_user');
    }

    public function profil()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Profil',
            'sub_title' => 'Data Profil',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('profil.v_index', $data);
    }

    public function edit_profil($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|email',
            'foto'              => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto.mimes'                => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto.max'                  => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        $user = $this->M_User->detail($id_user);

        if (Request()->foto <> "") {
            if ($user->foto <> "") {
                unlink(public_path('foto_user') . '/' . $user->foto);
            }

            $file = Request()->foto;
            $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
            $file->move(public_path('foto_user'), $fileUser);

            $data = [
                'id_user'           => $id_user,
                'nama'              => Request()->nama,
                'nomor_telepon'     => Request()->nomor_telepon,
                'email'             => Request()->email,
                'foto'              => $fileUser
            ];
        } else {
            $data = [
                'id_user'           => $id_user,
                'nama'              => Request()->nama,
                'nomor_telepon'     => Request()->nomor_telepon,
                'email'             => Request()->email,
            ];
        }

        $this->M_User->edit($data);
        Alert::success('Berhasil', 'Data profil berhasil diedit.');
        return redirect()->route('profil');
    }

    public function ubah_password()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Profil',
            'sub_title' => 'Ubah Password',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('profil.v_ubah_password', $data);
    }

    public function proses_ubah_password($id_user)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'password_lama'     => 'required|min:6',
            'password_baru'     => 'required|min:6',
        ], [
            'password_lama.required'    => 'Password Lama harus diisi!',
            'password_lama.min'         => 'Password Lama minimal 6 karakter!',
            'password_baru.required'    => 'Passwofd Baru harus diisi!',
            'password_baru.min'         => 'Password Lama minimal 6 karakter!',
        ]);

        $user = $this->M_User->detail($id_user);

        if (Hash::check(Request()->password_lama, $user->password)) {
            $data = [
                'id_user'         => $id_user,
                'password'        => Hash::make(Request()->password_baru)
            ];

            $this->M_User->edit($data);
            Alert::success('Berhasil', 'Data password berhasil diubah.');
            return back();
        } else {
            Alert::error('Gagal', 'Data password lama tidak sesuai.');
            return back();
        }
    }

    public function kirimJadwal($id) 
     {
         $sid = "AC3152032a13274daaa83569dad0c55b43";
         $token = "ffd93e355ec798e02be02dfc06a9fb28";
         $twilioNumber = "+14155238886";
         $recipientNumber = "+6282239668826";
         $client = new Client($sid, $token);
    
         $message = $client->messages->create(
             'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
             [
                 'from' => 'whatsapp:' . $twilioNumber,
                 'body' => 'Hallo,Ayo donor brok.', // Replace with your desired message
             ]
         );
    
         return response()->json(['message' => 'WhatsApp message sent successfully.', 'messageSid' => $message->sid]);
        }
    

    
}

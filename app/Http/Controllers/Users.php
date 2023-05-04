<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\ModelUser;
use App\Models\ModelBiodataWeb;
use GuzzleHttp\Psr7\Request;

class Users extends Controller
{

    private $ModelUser;
    private $ModelBiodataWeb;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelBiodataWeb = new ModelBiodataWeb();
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'subTitle'  => 'Kelola User',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'dataUser'  => $this->ModelUser->getData()
        ];

        return view('admin.users.data', $data);
    }

    public function add()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'subTitle'  => 'Tambah User',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('admin.users.add', $data);
    }

    public function addProcess()
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|unique:users,email|email',
            'password'          => 'min:6|required',
            'role'              => 'required',
            'foto_user'         => 'required|mimes:jpeg,png,jpg|max:2048',
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
            'foto_user.required'        => 'Foto Anda harus diisi!',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        $file1 = Request()->foto_user;
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

        $this->ModelUser->add($data);
        return redirect()->route('kelola-user')->with('berhasil', 'Data user berhasil ditambahkan !');
    }

    public function edit($id_user)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'subTitle'  => 'Edit User',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'detail'    => $this->ModelUser->detail($id_user),
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('admin.users.edit', $data);
    }

    public function editProcess($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|email',
            'role'              => 'required',
            'foto_user'         => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'role.required'             => 'Role harus diisi!',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Request()->password) {

            $user = $this->ModelUser->detail($id_user);

            if (Request()->foto_user <> "") {
                if ($user->foto <> "") {
                    unlink(public_path('foto_user') . '/' . $user->foto);
                }

                $file = Request()->foto_user;
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
            $user = $this->ModelUser->detail($id_user);

            if (Request()->foto_user <> "") {
                if ($user->foto <> "") {
                    unlink(public_path('foto_user') . '/' . $user->foto);
                }

                $file = Request()->foto_user;
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

        $this->ModelUser->edit($data);
        return redirect()->route('kelola-user')->with('berhasil', 'Data user berhasil diedit !');
    }

    public function detail($id_user)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'subTitle'  => 'Detail User',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'detail'    => $this->ModelUser->detail($id_user),
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('admin.users.detail', $data);
    }

    public function deleteProcess($id_user)
    {
        $user = $this->ModelUser->detail($id_user);

        if ($user->foto <> "") {
            unlink(public_path('foto_user') . '/' . $user->foto);
        }

        $this->ModelUser->deleteData($id_user);
        return redirect()->route('kelola-user')->with('berhasil', 'Data user berhasil dihapus !');
    }

    public function profil()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Profil',
            'subTitle'  => 'Informasi Profil',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('profil.data', $data);
    }

    public function editProfilProcess($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|email',
            'foto_user'         => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        $user = $this->ModelUser->detail($id_user);

        if (Request()->foto_user <> "") {
            if ($user->foto <> "") {
                unlink(public_path('foto_user') . '/' . $user->foto);
            }

            $file = Request()->foto_user;
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

        if (Session()->get('role') === 'Admin') {
            $route = 'profil-admin';
        } elseif (Session()->get('role') === 'Wakil Direktur') {
            $route = 'profil-wadir';
        } elseif (Session()->get('role') === 'Ketua Jurusan') {
            $route = 'profil-kajur';
        } elseif (Session()->get('role') === 'Pegawai') {
            $route = 'profil';
        }

        $this->ModelUser->edit($data);
        return redirect()->route($route)->with('berhasil', 'Profil berhasil diedit !');
    }

    public function ubahPassword($id_member)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }


        $data = [
            'title'     => 'Ubah Password',
            'biodata'   => $this->ModelBiodataWeb->detail(1),
            'user'      => $this->ModelUser->detail($id_member)
        ];

        return view('user.profil.ubahPassword', $data);
    }

    public function changePasswordProcess($id_user)
    {
        Request()->validate([
            'password_lama'     => 'required|min:6',
            'password_baru'     => 'required|min:6',
        ], [
            'password_lama.required'    => 'Password Lama harus diisi!',
            'password_lama.min'         => 'Password Lama minimal 6 karakter!',
            'password_baru.required'    => 'Passwofd Baru harus diisi!',
            'password_baru.min'         => 'Password Lama minimal 6 karakter!',
        ]);

        $user = $this->ModelUser->detail($id_user);

        if (Hash::check(Request()->password_lama, $user->password)) {
            $data = [
                'id_user'         => $id_user,
                'password'          => Hash::make(Request()->password_baru)
            ];

            $this->ModelUser->edit($data);
            return back()->with('berhasil-ubah-password', 'Password berhasil diubah !');
        } else {
            return back()->with('gagal-ubah-password', 'Password Lama tidak sesuai.');
        }
    }
}

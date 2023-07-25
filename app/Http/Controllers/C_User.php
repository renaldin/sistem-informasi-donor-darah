<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Anggota;
use DateTime;
use RealRashid\SweetAlert\Facades\Alert;

class C_User extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Anggota;
    private $public_path;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Anggota = new M_Anggota();
        $this->public_path = 'foto_user';
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

    public function tambah_petugas_kesehatan()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Tambah User',
            'data_web'  => $this->M_Website->detail(1),
            'role'      => 'Petugas Kesehatan',
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_tambah', $data);
    }

    public function tambah_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Tambah User',
            'data_web'  => $this->M_Website->detail(1),
            'role'      => 'Event',
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_tambah', $data);
    }

    public function tambah_donatur()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Tambah User',
            'data_web'  => $this->M_Website->detail(1),
            'role'      => 'Donatur',
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_tambah', $data);
    }

    public function tambah_rumah_sakit()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Tambah User',
            'data_web'  => $this->M_Website->detail(1),
            'role'      => 'Rumah Sakit',
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_tambah', $data);
    }

    public function proses_tambah_user()
    {
        Request()->validate([
            'nama'              => 'required',
            'alamat_user'       => 'required',
            'nomor_telepon'     => 'required|min:12|max:13',
            'email'             => 'required|unique:user,email|email',
            'password'          => 'min:6|required',
            'role'              => 'required',
            'foto'              => 'required|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'alamat_user.required'      => 'Alamat harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.min'         => 'Nomor telepon minimal 12 digit!',
            'nomor_telepon.max'         => 'Nomor telepon maksimal 13 digit!',
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

        if (Request()->role === 'Donatur') {

            if (Request()->kartu === 'KTP') {
                $rules = 'required|min:16|max:16|unique:user_donatur,nik';
                $pesanRules = 'NIK harus 16 karakter';
            } else {
                $rules = 'required|min:12|max:12|unique:user_donatur,nik';
                $pesanRules = 'No. SIM harus 12 karakter';
            }

            Request()->validate([
                'nik'               => $rules,
                'tanggal_lahir'     => 'required|date',
                'jk'                => 'required',
                'kartu'                => 'required',
            ], [
                'nik.required'              => 'NIK harus diisi!',
                // 'nik.numeric'               => 'NIK harus angka!',
                'nik.min'               => $pesanRules,
                'nik.max'               => $pesanRules,
                'nik.unique'               => 'NIK sudah terdaftar!',
                'tanggal_lahir.required'    => 'Tanggal lahir harus diisi!',
                'tanggal_lahir.date'        => 'Tanggal lahir berupa tanggal!',
                'jk.required'               => 'Jenis kelamin harus diisi!',
                'kartu.required'               => 'Kartu harus diisi!',
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

        $file1 = Request()->foto;
        $fileUser = date('mdYHis') . Request()->nama . '.' . $file1->extension();
        $file1->move(public_path($this->public_path), $fileUser);

        $data = [
            'nama'              => Request()->nama,
            'alamat_user'       => Request()->alamat_user,
            'nomor_telepon'     => Request()->nomor_telepon,
            'email'             => Request()->email,
            'password'          => Hash::make(Request()->password),
            'role'              => Request()->role,
            'status_verifikasi'              => 'Sudah',
            'foto'              => $fileUser,
        ];

        $this->M_User->tambah($data);
        $data_terakhir = $this->M_User->last_data();

        if (Request()->role === 'Donatur') {
            $data_donatur = [
                'id_user'       => $data_terakhir->id_user,
                'kartu'           => Request()->kartu,
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

        Alert::success('Berhasil', 'Data user berhasil ditambah.');
        return redirect()->route('data_user');
    }

    public function edit_user($id_user)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $user = $this->M_User->detail($id_user);

        if ($user->role === 'Donatur') {
            $detail = $this->M_User->detail_user_donatur($id_user);
        } elseif ($user->role === 'Event') {
            $detail = $this->M_User->detail_user_event($id_user);
        } elseif ($user->role === 'Rumah Sakit') {
            $detail = $this->M_User->detail_user_rs($id_user);
        } else {
            $detail = $user;
        }

        $data = [
            'title'     => 'Data User',
            'sub_title' => 'Edit User',
            'data_web'  => $this->M_Website->detail(1),
            'detail'    => $detail,
            'user'      => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.user.v_edit', $data);
    }

    public function proses_edit_user($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'alamat_user'       => 'required',
            'nomor_telepon'     => 'required|min:12|max:13',
            'email'             => 'required|email',
            'foto'              => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.min'         => 'Nomor telepon minimal 12 digit!',
            'nomor_telepon.max'         => 'Nomor telepon maksimal 13 digit!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto.mimes'                => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto.max'                  => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Request()->role === 'Donatur') {

            if (Request()->kartu === 'KTP') {
                $rules = 'required|min:16|max:16';
                $pesanRules = 'NIK harus 16 karakter';
            } else {
                $rules = 'required|min:12|max:12';
                $pesanRules = 'No. SIM harus 12 karakter';
            }

            Request()->validate([
                'nik'               => $rules,
                'tanggal_lahir'     => 'required|date',
                'jk'                => 'required',
                'kartu'                => 'required',
            ], [
                'nik.required'              => 'NIK harus diisi!',
                // 'nik.numeric'               => 'NIK harus angka!',
                'nik.min'               => $pesanRules,
                'nik.max'               => $pesanRules,
                'tanggal_lahir.required'    => 'Tanggal lahir harus diisi!',
                'tanggal_lahir.date'        => 'Tanggal lahir berupa tanggal!',
                'jk.required'               => 'Jenis kelamin harus diisi!',
                'kartu.required'               => 'Kartu harus diisi!',
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

        if (Request()->password) {

            $user = $this->M_User->detail($id_user);

            if (Request()->foto <> "") {
                if ($user->foto <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto);
                }

                $file = Request()->foto;
                $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'alamat_user'       => Request()->alamat_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'password'          => Hash::make(Request()->password),
                    'foto '             => $fileUser,
                ];
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'alamat_user'       => Request()->alamat_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'password'          => Hash::make(Request()->password),
                ];
            }
        } else {
            $user = $this->M_User->detail($id_user);

            if (Request()->foto <> "") {
                if ($user->foto <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto);
                }

                $file = Request()->foto;
                $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'alamat_user'       => Request()->alamat_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                    'foto'              => $fileUser,
                ];
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama'              => Request()->nama,
                    'alamat_user'       => Request()->alamat_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'email'             => Request()->email,
                ];
            }
        }

        $this->M_User->edit($data);

        if (Request()->role === 'Donatur') {
            $data_donatur = [
                'id_user'       => $id_user,
                'kartu'           => Request()->kartu,
                'nik'           => Request()->nik,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'jk'            => Request()->jk,
                'gol_darah'     => Request()->gol_darah,
            ];

            $this->M_User->edit_user_donatur($data_donatur);

            $detail_anggota = $this->M_Anggota->cek_nik(Request()->nik);
            if ($detail_anggota !== null) {
                $data_anggota = [
                    'id_anggota' => $detail_anggota->id_anggota,
                    'no_wa' => Request()->nomor_telepon,
                ];
                $this->M_Anggota->edit($data_anggota);
            }
        } elseif (Request()->role === 'Event') {
            $data_event = [
                'id_user'       => $id_user,
                'kode_instansi' => Request()->kode_instansi,
            ];

            $this->M_User->edit_user_event($data_event);
        } elseif (Request()->role === 'Rumah Sakit') {
            $data_rs = [
                'id_user'       => $id_user,
                'kode_rs'       => Request()->kode_rs,
            ];

            $this->M_User->edit_user_rumah_sakit($data_rs);
        }

        Alert::success('Berhasil', 'Data stok darah berhasil diedit.');
        return redirect()->route('data_user');
    }

    public function hapus_user($id_user)
    {
        $user = $this->M_User->detail($id_user);

        if ($user->foto <> "") {
            unlink(public_path($this->public_path) . '/' . $user->foto);
        }

        if ($user->role === 'Donatur') {
            $this->M_User->hapus_user_donatur($id_user);
        } elseif ($user->role === 'Event') {
            $this->M_User->hapus_user_event($id_user);
        } elseif ($user->role === 'Rumah Sakit') {
            $this->M_User->hapus_user_rs($id_user);
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

        if (Session()->get('role') === 'Donatur') {
            $user = $this->M_User->detail_user_donatur(Session()->get('id_user'));
        } elseif (Session()->get('role') === 'Event') {
            $user = $this->M_User->detail_user_event(Session()->get('id_user'));
        } elseif (Session()->get('role') === 'Rumah Sakit') {
            $user = $this->M_User->detail_user_rs(Session()->get('id_user'));
        } else {
            $user = $this->M_User->detail(Session()->get('id_user'));
        }

        $data = [
            'title'     => 'Profil',
            'sub_title' => 'Data Profil',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $user,
        ];

        return view('profil.v_index', $data);
    }

    public function edit_profil($id_user)
    {
        Request()->validate([
            'nama'              => 'required',
            'alamat_user'       => 'required',
            'nomor_telepon'     => 'required|min:12|max:13',
            'email'             => 'required|email',
            'foto'              => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'             => 'Nama lengkap harus diisi!',
            'alamat_user.required'      => 'Alamat harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nomor_telepon.min'         => 'Nomor telepon minimal 12 digit!',
            'nomor_telepon.max'         => 'Nomor telepon maksimal 13 digit!',
            'email.required'            => 'Email harus diisi!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto.mimes'                => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto.max'                  => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Session()->get('role') === 'Donatur') {
            if (Request()->kartu === 'KTP') {
                $rules = 'required|min:16|max:16';
                $pesanRules = 'NIK harus 16 karakter';
            } else {
                $rules = 'required|min:12|max:12';
                $pesanRules = 'No. SIM harus 12 karakter';
            }

            Request()->validate([
                'nik'               => $rules,
                'tanggal_lahir'     => 'required|date',
                'jk'                => 'required',
            ], [
                'nik.required'              => 'NIK harus diisi!',
                // 'nik.numeric'               => 'NIK harus angka!',
                'nik.min'               => $pesanRules,
                'nik.max'               => $pesanRules,
                'tanggal_lahir.required'    => 'Tanggal lahir harus diisi!',
                'tanggal_lahir.date'        => 'Tanggal lahir berupa tanggal!',
                'jk.required'               => 'Jenis kelamin harus diisi!',
            ]);

            $tanggal_lahir = new DateTime(Request()->tanggal_lahir);
            $sekarang = new DateTime();
            $selisih = $sekarang->diff($tanggal_lahir);
            $umur = $selisih->y;

            if ($umur < 17) {
                Alert::error('Gagal', "Umur Anda kurang dari 17 tahun!");
                return redirect()->route('profil');
            }

            $user = $this->M_User->detail_user_donatur(Session()->get('id_user'));

            $data_donatur = [
                'id_user_donatur' => $user->id_user_donatur,
                'id_user'         => $id_user,
                'kartu'             => Request()->kartu,
                'nik'             => Request()->nik,
                'tanggal_lahir'   => Request()->tanggal_lahir,
                'jk'              => Request()->jk,
                'gol_darah'       => Request()->gol_darah,
            ];
            $this->M_User->edit_donatur($data_donatur);

            $detail_anggota = $this->M_Anggota->cek_nik(Request()->nik);
            if ($detail_anggota !== null) {
                $data_anggota = [
                    'id_anggota' => $detail_anggota->id_anggota,
                    'no_wa' => Request()->nomor_telepon,
                ];
                $this->M_Anggota->edit($data_anggota);
            }
        } elseif (Session()->get('role') === 'Event') {
            $user = $this->M_User->detail_user_event(Session()->get('id_user'));

            $data_event = [
                'id_user_event'     => $user->id_user_event,
                'id_user'           => $id_user,
                'kode_instansi'     => Request()->kode_instansi,
            ];
            $this->M_User->edit_event($data_event);
        } elseif (Session()->get('role') === 'Rumah Sakit') {
            $user = $this->M_User->detail_user_rs(Session()->get('id_user'));

            $data_rs = [
                'id_user_rs'        => $user->id_user_rs,
                'id_user'           => $id_user,
                'kode_rs'           => Request()->kode_rs,
            ];
            $this->M_User->edit_rs($data_rs);
        } else {
            $user = $this->M_User->detail(Session()->get('id_user'));
        }

        if (Request()->foto <> "") {
            if ($user->foto <> "") {
                unlink(public_path($this->public_path) . '/' . $user->foto);
            }

            $file = Request()->foto;
            $fileUser = date('mdYHis') . Request()->nama . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileUser);

            $data = [
                'id_user'           => $id_user,
                'nama'              => Request()->nama,
                'alamat_user'       => Request()->alamat_user,
                'nomor_telepon'     => Request()->nomor_telepon,
                'email'             => Request()->email,
                'foto'              => $fileUser
            ];
        } else {
            $data = [
                'id_user'           => $id_user,
                'nama'              => Request()->nama,
                'alamat_user'       => Request()->alamat_user,
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
}

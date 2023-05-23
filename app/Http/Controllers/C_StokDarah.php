<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Darah;
use App\Models\M_DarahMasuk;
use App\Models\M_DarahBuang;
use App\Models\M_Anggota;
use RealRashid\SweetAlert\Facades\Alert;

class C_StokDarah extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Darah;
    private $M_DarahMasuk;
    private $M_DarahBuang;
    private $M_Anggota;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Darah = new M_Darah();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_DarahBuang = new M_DarahBuang();
        $this->M_Anggota = new M_Anggota();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Data Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('admin.stok_darah.v_index', $data);
    }

    public function tambah_darah_online()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $dataTerakhir = $this->M_Darah->data_terakhir();

        if ($dataTerakhir === null) {
            $no_kantong = 'K1';
        } else {
            $kata = $dataTerakhir->no_kantong;
            // $kata = 'K1';
            $angka = substr($kata, 1) + 1;
            $no_kantong = 'K' . $angka;
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'anggota'       => $this->M_Anggota->get_data(),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_online', $data);
    }

    public function tambah_darah_offline()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $dataTerakhir = $this->M_Darah->data_terakhir();

        if ($dataTerakhir === null) {
            $no_kantong = 'K1';
        } else {
            $kata = $dataTerakhir->no_kantong;
            // $kata = 'K1';
            $angka = substr($kata, 1) + 1;
            $no_kantong = 'K' . $angka;
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_offline', $data);
    }

    public function proses_tambah_darah()
    {
        if (Request()->form_darah == 'Online') {
            Request()->validate([
                'golongan_darah'        => 'required',
                'resus'                 => 'required',
                'volume_darah'          => 'required',
                'tanggal_kedaluwarsa'   => 'required',
            ], [
                'golongan_darah.required'       => 'Golongan darah harus diisi!',
                'resus.required'                => 'Resus harus diisi!',
                'volume_darah.required'         => 'Volume darah harus diisi!',
                'tanggal_kedaluwarsa.required'  => 'Tanggal kedaluwarsa harus diisi!',
            ]);

            $data_darah = [
                'id_anggota'            => Request()->id_anggota,
                'no_kantong'            => Request()->no_kantong,
                'golongan_darah'        => Request()->golongan_darah,
                'resus'                 => Request()->resus,
                'volume_darah'          => Request()->volume_darah,
                'tanggal_kedaluwarsa'   => Request()->tanggal_kedaluwarsa,
                'tanggal_darah_masuk'   => date('Y-m-d H:i:s')
            ];
            $this->M_Darah->tambah($data_darah);

            $data_terakhir = $this->M_Darah->data_terakhir();

            $data_darah_masuk = [
                'id_darah'      => $data_terakhir->id_darah,
                'id_user'       => Session()->get('id_user'),
            ];
            $this->M_DarahMasuk->tambah($data_darah_masuk);

            $data_anggota = [
                'id_anggota'        => Request()->id_anggota,
                // 'status_anggota'    => 'Selesai'
            ];
            $this->M_Anggota->edit($data_anggota);

            Alert::success('Berhasil', 'Data darah berhasil ditambah.');
            return redirect()->route('tambah_darah_online');
        } elseif (Request()->form_darah == 'Offline') {
            Request()->validate([
                'nama_anggota'          => 'required',
                'alamat'                => 'required',
                'jenis_kelamin'         => 'required',
                'tanggal_terakhir_donor' => 'required',
                'golongan_darah'        => 'required',
                'resus'                 => 'required',
                'volume_darah'          => 'required',
                'tanggal_kedaluwarsa'   => 'required',
            ], [
                'nama_anggota.required'         => 'Nama anggota harus diisi!',
                'alamat.required'               => 'Alamat harus diisi!',
                'jenis_kelamin.required'        => 'Jenis kelamin harus diisi!',
                'tanggal_terakhir_donor.required' => 'Tanggal terakhir donor harus diisi!',
                'golongan_darah.required'       => 'Golongan darah harus diisi!',
                'resus.required'                => 'Resus harus diisi!',
                'volume_darah.required'         => 'Volume darah harus diisi!',
                'tanggal_kedaluwarsa.required'  => 'Tanggal kedaluwarsa harus diisi!',
            ]);

            $data_anggota = [
                'nama_anggota'      => Request()->nama_anggota,
                'alamat'            => Request()->alamat,
                'jenis_kelamin'     => Request()->jenis_kelamin,
                'tanggal_terakhir_donor' => Request()->tanggal_terakhir_donor,
                // 'status_anggota'    => 'Selesai'
            ];
            $this->M_Anggota->tambah($data_anggota);

            $data_terakhir_anggota = $this->M_Anggota->data_terakhir();

            $data_darah = [
                'id_anggota'            => $data_terakhir_anggota->id_anggota,
                'no_kantong'            => Request()->no_kantong,
                'golongan_darah'        => Request()->golongan_darah,
                'resus'                 => Request()->resus,
                'volume_darah'          => Request()->volume_darah,
                'tanggal_kedaluwarsa'   => Request()->tanggal_kedaluwarsa,
                'tanggal_darah_masuk'   => date('Y-m-d H:i:s')
            ];
            $this->M_Darah->tambah($data_darah);

            $data_terakhir_darah = $this->M_Darah->data_terakhir();

            $data_darah_masuk = [
                'id_darah'      => $data_terakhir_darah->id_darah,
                'id_user'       => Session()->get('id_user'),
            ];
            $this->M_DarahMasuk->tambah($data_darah_masuk);

            Alert::success('Berhasil', 'Data darah berhasil ditambah.');
            return redirect()->route('tambah_darah_offline');
        }
    }

    public function edit_darah($id_darah_masuk)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Edit Darah',
            'data_web'      => $this->M_Website->detail(1),
            'detail'        => $this->M_DarahMasuk->detail($id_darah_masuk),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_edit', $data);
    }

    public function proses_edit_darah($id_darah_masuk)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'golongan_darah'        => 'required',
            'resus'                 => 'required',
            'volume_darah'          => 'required',
            'tanggal_kedaluwarsa'   => 'required',
        ], [
            'golongan_darah.required'       => 'Golongan darah harus diisi!',
            'resus.required'                => 'Resus harus diisi!',
            'volume_darah.required'         => 'Volume darah harus diisi!',
            'tanggal_kedaluwarsa.required'  => 'Tanggal kedaluwarsa harus diisi!',
        ]);

        $darah_masuk = $this->M_DarahMasuk->detail($id_darah_masuk);

        $data_darah = [
            'id_darah'              => $darah_masuk->id_darah,
            'no_kantong'            => Request()->no_kantong,
            'golongan_darah'        => Request()->golongan_darah,
            'resus'                 => Request()->resus,
            'volume_darah'          => Request()->volume_darah,
            'tanggal_kedaluwarsa'   => Request()->tanggal_kedaluwarsa,
        ];
        $this->M_Darah->edit($data_darah);

        $data_darah_masuk = [
            'id_darah_masuk' => $darah_masuk->id_darah_masuk,
            'id_darah'       => $darah_masuk->id_darah,
            'id_user'        => Session()->get('id_user'),
        ];
        $this->M_DarahMasuk->edit($data_darah_masuk);

        Alert::success('Berhasil', 'Data darah berhasil diedit.');
        return redirect()->route('data_stok_darah');
    }

    public function buang_darah($id_darah_masuk)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $darah_masuk = $this->M_DarahMasuk->detail($id_darah_masuk);

        $data_darah_buang = [
            'id_darah'          => $darah_masuk->id_darah,
            'id_user'           => Session()->get('id_user'),
            'tanggal_buang'     => date('Y-m-d H:i:s')
        ];
        $this->M_DarahBuang->tambah($data_darah_buang);

        $this->M_DarahMasuk->hapus($id_darah_masuk);
        Alert::success('Berhasil', 'Data darah berhasil dibuang.');
        return redirect()->route('data_stok_darah');
    }

    public function riwayat_buang_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Riwayat Buang Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahBuang->get_data()
        ];

        return view('admin.stok_darah.v_riwayat_buang_darah', $data);
    }
}

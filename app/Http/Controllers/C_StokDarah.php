<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Darah;
use App\Models\M_DarahMasuk;
use App\Models\M_DarahBuang;
use App\Models\M_Anggota;
use App\Models\M_Donor;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class C_StokDarah extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Darah;
    private $M_DarahMasuk;
    private $M_DarahBuang;
    private $M_Anggota;
    private $M_Donor;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Darah = new M_Darah();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_DarahBuang = new M_DarahBuang();
        $this->M_Anggota = new M_Anggota();
        $this->M_Donor = new M_Donor();
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
            'title'         => 'Data Darah Masuk',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'donor'         => $this->M_Donor->get_data(),
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
            'title'         => 'Data Darah Masuk',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_offline', $data);
    }

    public function tambah_darah_offline_anggota()
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
            'title'         => 'Data Darah Masuk',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'anggota'       => $this->M_Anggota->get_data(),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_offline_anggota', $data);
    }

    public function proses_tambah_darah()
    {
        if (Request()->form_darah == 'Online') {
            Request()->validate([
                'golongan_darah'        => 'required',
                'resus'                 => 'required',
                'volume_darah'          => 'required',
            ], [
                'golongan_darah.required'       => 'Golongan darah harus diisi!',
                'resus.required'                => 'Resus harus diisi!',
                'volume_darah.required'         => 'Volume darah harus diisi!',
            ]);

            $data_darah = [
                'id_donor'              => Request()->id_donor,
                'no_kantong'            => Request()->no_kantong,
                'golongan_darah'        => Request()->golongan_darah,
                'resus'                 => Request()->resus,
                'volume_darah'          => Request()->volume_darah,
                'tanggal_kedaluwarsa'   => date('Y-m-d', strtotime('+35 days', strtotime(date('Y-m-d')))),
                'tanggal_darah_masuk'   => date('Y-m-d H:i:s')
            ];
            $this->M_Darah->tambah($data_darah);

            $data_terakhir = $this->M_Darah->data_terakhir();

            $data_darah_masuk = [
                'id_darah'      => $data_terakhir->id_darah,
                'id_user'       => Session()->get('id_user'),
                'tanggal_masuk' => date('Y-m-d H:i:s')
            ];
            $this->M_DarahMasuk->tambah($data_darah_masuk);

            $data_donor = [
                'id_donor'      => Request()->id_donor,
                'status_donor'  => 'Selesai'
            ];
            $this->M_Donor->edit($data_donor);

            $detail_donor = $this->M_Donor->detail(Request()->id_donor);

            $data_anggota = [
                'id_anggota'            => $detail_donor->id_anggota,
                'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
            ];
            $this->M_Anggota->edit($data_anggota);

            $anggota = $this->M_Anggota->detail($detail_donor->id_anggota);
            $user_donatur = $this->M_User->detail_user_donatur_nik($anggota->nik);
            if ($user_donatur) {
                $data_user_donatur = [
                    'id_user_donatur'   => $user_donatur->id_user_donatur,
                    'gol_darah'         => Request()->golongan_darah
                ];
                $this->M_User->edit_donatur($data_user_donatur);
            }

            Alert::success('Berhasil', 'Data darah berhasil ditambah.');
            return redirect()->route('tambah_darah_online');
        } elseif (Request()->form_darah == 'Offline') {
            if (Request()->form_anggota == 'Anggota') {
                Request()->validate([
                    'id_anggota'            => 'required',
                    'hasil_kusioner'        => 'required',
                    'deskripsi_hasil_kusioner'        => 'required',
                    'golongan_darah'        => 'required',
                    'resus'                 => 'required',
                    'volume_darah'          => 'required',
                ], [
                    'id_anggota.required'               => 'Nama anggota harus diisi!',
                    'hasil_kusioner.required'           => 'Hasil kusioner harus diisi!',
                    'deskripsi_hasil_kusioner.required' => 'Deskripsi hasil kusioner harus diisi!',
                    'golongan_darah.required'       => 'Golongan darah harus diisi!',
                    'resus.required'                => 'Resus harus diisi!',
                    'volume_darah.required'         => 'Volume darah harus diisi!',
                ]);

                $data_donor = [
                    'id_anggota'                => Request()->id_anggota,
                    'tanggal_donor'             => date('Y-m-d H:i:s'),
                    'status_donor'              => 'Selesai',
                    'hasil_kusioner'            => Request()->hasil_kusioner,
                    'deskripsi_hasil_kusioner'  => Request()->deskripsi_hasil_kusioner,
                ];
                $this->M_Donor->tambah($data_donor);

                $data_anggota = [
                    'id_anggota'    => Request()->id_anggota,
                    'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
                ];
                $this->M_Anggota->edit($data_anggota);

                $id_anggota = Request()->id_anggota;
            } elseif (Request()->form_anggota == 'Non Anggota') {
                if (Request()->kartu === 'KTP') {
                    $rules = 'required|min:16|max:16|unique:anggota,nik';
                    $pesanRules = 'NIK harus 16 karakter';
                } else {
                    $rules = 'required|min:12|max:12|unique:anggota,nik';
                    $pesanRules = 'No. SIM harus 12 karakter';
                }

                Request()->validate([
                    'nama_anggota'              => 'required',
                    'alamat'                    => 'required',
                    'kecamatan'                 => 'required',
                    'kabupaten'                 => 'required',
                    'nik'                       => $rules,
                    'no_wa'                     => 'required|min:12|max:13',
                    'jenis_kelamin'             => 'required',
                    'hasil_kusioner'            => 'required',
                    'deskripsi_hasil_kusioner'  => 'required',
                    'golongan_darah'            => 'required',
                    'resus'                     => 'required',
                    'volume_darah'              => 'required',
                ], [
                    'nama_anggota.required'             => 'Nama anggota harus diisi!',
                    'alamat.required'                   => 'Alamat harus diisi!',
                    'kecamatan.required'                => 'Kecamatan harus diisi!',
                    'kabupaten.required'                => 'Kabupaten harus diisi!',
                    'nik.required'                      => 'NIK harus diisi!',
                    'nik.min'                           => $pesanRules,
                    'nik.max'                           => $pesanRules,
                    'nik.unique'                        => 'NIK sudah terdaftar!',
                    'no_wa.required'                    => 'Nomor WA harus diisi!',
                    'no_wa.min'                         => 'Nomor WA minimal 12 digit!',
                    'no_wa.max'                         => 'Nomor WA maksimal 13 digit!',
                    'jenis_kelamin.required'            => 'Jenis kelamin harus diisi!',
                    'hasil_kusioner.required'           => 'Hasil kusioner harus diisi!',
                    'deskripsi_hasil_kusioner.required' => 'Deskripsi hasil kusioner harus diisi!',
                    'golongan_darah.required'           => 'Golongan darah harus diisi!',
                    'resus.required'                    => 'Resus harus diisi!',
                    'volume_darah.required'             => 'Volume darah harus diisi!',
                ]);

                $data_anggota = [
                    'nama_anggota'          => Request()->nama_anggota,
                    'nik'                   => Request()->nik,
                    'alamat'                => Request()->alamat,
                    'kecamatan'             => Request()->kecamatan,
                    'kabupaten'             => Request()->kabupaten,
                    'no_wa'                 => Request()->no_wa,
                    'jenis_kelamin'         => Request()->jenis_kelamin,
                    'status_anggota'        => 'Mandiri',
                    'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
                ];
                $this->M_Anggota->tambah($data_anggota);

                $data_terakhir_anggota = $this->M_Anggota->data_terakhir();

                $data_donor = [
                    'id_anggota'                => $data_terakhir_anggota->id_anggota,
                    'tanggal_donor'             => date('Y-m-d H:i:s'),
                    'status_donor'              => 'Selesai',
                    'hasil_kusioner'            => Request()->hasil_kusioner,
                    'deskripsi_hasil_kusioner'  => Request()->deskripsi_hasil_kusioner,
                ];
                $this->M_Donor->tambah($data_donor);

                $id_anggota = $data_terakhir_anggota->id_anggota;
            }

            $data_terakhir_donor = $this->M_Donor->data_terakhir();

            $data_darah = [
                'id_donor'              => $data_terakhir_donor->id_donor,
                'no_kantong'            => Request()->no_kantong,
                'golongan_darah'        => Request()->golongan_darah,
                'resus'                 => Request()->resus,
                'volume_darah'          => Request()->volume_darah,
                'tanggal_kedaluwarsa'   => date('Y-m-d', strtotime('+35 days', strtotime(date('Y-m-d')))),
                'tanggal_darah_masuk'   => date('Y-m-d H:i:s')
            ];
            $this->M_Darah->tambah($data_darah);

            $data_terakhir_darah = $this->M_Darah->data_terakhir();

            $data_darah_masuk = [
                'id_darah'      => $data_terakhir_darah->id_darah,
                'id_user'       => Session()->get('id_user'),
                'tanggal_masuk' => date('Y-m-d H:i:s')
            ];
            $this->M_DarahMasuk->tambah($data_darah_masuk);

            $anggota = $this->M_Anggota->detail($id_anggota);
            $user_donatur = $this->M_User->detail_user_donatur_nik($anggota->nik);
            if ($user_donatur) {
                $data_user_donatur = [
                    'id_user_donatur'   => $user_donatur->id_user_donatur,
                    'gol_darah'         => Request()->golongan_darah
                ];
                $this->M_User->edit_donatur($data_user_donatur);
            }

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
            'title'         => 'Data Darah Masuk',
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
        ], [
            'golongan_darah.required'       => 'Golongan darah harus diisi!',
            'resus.required'                => 'Resus harus diisi!',
            'volume_darah.required'         => 'Volume darah harus diisi!',
        ]);

        $darah_masuk = $this->M_DarahMasuk->detail($id_darah_masuk);

        $data_darah = [
            'id_darah'              => $darah_masuk->id_darah,
            'no_kantong'            => Request()->no_kantong,
            'golongan_darah'        => Request()->golongan_darah,
            'resus'                 => Request()->resus,
            'volume_darah'          => Request()->volume_darah,
        ];
        $this->M_Darah->edit($data_darah);

        $data_darah_masuk = [
            'id_darah_masuk' => $darah_masuk->id_darah_masuk,
            'id_darah'       => $darah_masuk->id_darah,
            'id_user'        => Session()->get('id_user'),
            'tanggal_masuk'  => date('Y-m-d H:i:s')
        ];
        $this->M_DarahMasuk->edit($data_darah_masuk);

        Alert::success('Berhasil', 'Data darah berhasil diedit.');
        return redirect()->route('data_darah_masuk');
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

    public function masuk_darah($id_darah_masuk)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_darah_masuk'    => $id_darah_masuk,
            'status_darah_masuk' => 'Sudah Masuk',
        ];

        $this->M_DarahMasuk->edit($data);
        Alert::success('Berhasil', 'Data darah berhasil dibuang.');
        return redirect()->route('data_darah_masuk');
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

    public function data_darah_masuk()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data Darah Masuk',
            'sub_title'     => 'Data Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('admin.darah_masuk.v_index', $data);
    }

    public function buang_darah_kedaluwarsa()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $darah_masuk = $this->M_DarahMasuk->kedaluwarsa();

        foreach ($darah_masuk as $row) {
            $data_darah_buang = [
                'id_darah'          => $row->id_darah,
                'id_user'           => Session()->get('id_user'),
                'tanggal_buang'     => date('Y-m-d H:i:s')
            ];
            $this->M_DarahBuang->tambah($data_darah_buang);
            $this->M_DarahMasuk->hapus($row->id_darah_masuk);
        }

        Alert::success('Berhasil', 'Data darah berhasil dibuang.');
        return redirect()->route('data_stok_darah');
    }

    public function cetak_invoice_darah($id_darah_masuk)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Invoice Stok Darah',
            'data_web'      => $this->M_Website->detail(1),
            'data_darah'    => $this->M_DarahMasuk->detail($id_darah_masuk)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_invoice_darah', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function get_nik_by_donor($id)
    {
        $donor = $this->M_Donor->detail($id);
        $anggota = $this->M_Anggota->detail($donor->id_anggota);
        $user_donatur = $this->M_User->detail_user_donatur_nik($anggota->nik);
        echo $user_donatur->gol_darah;
    }
}

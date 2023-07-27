<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_PermohonanDarah;
use App\Models\M_DarahKeluar;
use App\Models\M_DarahMasuk;
use Illuminate\Contracts\Session\Session;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class C_PermohonanDarah extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_PermohonanDarah;
    private $M_DarahKeluar;
    private $M_DarahMasuk;
    private $public_path;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_PermohonanDarah = new M_PermohonanDarah();
        $this->M_DarahKeluar = new M_DarahKeluar();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->public_path = 'surat_permohonan_darah';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Permohonan Darah',
            'sub_title'             => 'Data Permohonan Darah',
            'data_web'              => $this->M_Website->detail(1),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'data_permohonan_darah' => $this->M_PermohonanDarah->get_data_user(Session()->get('id_user')),
            'data_darah_keluar'     => $this->M_DarahKeluar->get_data()
        ];

        return view('rumah_sakit.permohonan_darah.v_index', $data);
    }

    public function tambah_permohonan_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Permohonan Darah',
            'sub_title'             => 'Tambah Permohonan Darah',
            'data_web'              => $this->M_Website->detail(1),
            'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
            'stok'                  => $this->M_DarahMasuk->countGolJenisDarah('Sudah Masuk'),
            'user'                  => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('rumah_sakit.permohonan_darah.v_tambah', $data);
    }

    public function proses_tambah_permohonan_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_rs'           => 'required',
            'nama_dokter'       => 'required',
            'nama_pasien'       => 'required',
            'golda'             => 'required',
            'rhesus'             => 'required',
            'jenis_darah'             => 'required',
            'jumlah'            => 'required|numeric',
            'upload_surat'      => 'required|mimes:pdf|max:5048',
        ], [
            'nama_rs.required'          => 'Nama Rumah Sakit harus diisi!',
            'nama_dokter.required'      => 'Nama Dokter harus diisi!',
            'nama_pasien.required'      => 'Nama Pasien harus diisi!',
            'golda.required'            => 'Golongan Darah harus diisi!',
            'rhesus.required'            => 'Rhesus harus diisi!',
            'jenis_darah.required'            => 'Jenis Darah harus diisi!',
            'jumlah.required'           => 'Jumlah (Kantong) harus diisi!',
            'jumlah.numeric'            => 'Jumlah (Kantong) harus diisi!',
            'upload_surat.required'     => 'Surat harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);

        $stok = $this->M_DarahMasuk->countGolJenisDarah('Sudah Masuk');
        $golda = Request()->golda;
        $rhesus = Request()->rhesus;
        $jumlah = Request()->jumlah;
        $jenisDarah = Request()->jenis_darah;

        if ($golda == 'A' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['a+segar']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['a+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['a+baru']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['a+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['a+simpan']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['a+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'B' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['b+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['b+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['b+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['b+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['b+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['b+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'AB' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['ab+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['ab+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['ab+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['ab+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['ab+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['ab+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'O' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['o+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['o+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['o+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['o+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['o+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['o+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'A' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['a-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['a-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['a-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['a-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['a-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['a-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'B' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['b-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['b-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['b-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['b-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['b-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['b-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'AB' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['ab-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['ab-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['ab-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['ab-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['ab-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['ab-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'O' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['o-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['o-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['o-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['o-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['o-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['o-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        }

        $file = Request()->upload_surat;
        $file_surat = date('mdYHis') . ' ' . Request()->nama_rs . '.' . $file->extension();
        $file->move(public_path($this->public_path), $file_surat);

        $data = [
            'id_user'               => Session()->get('id_user'),
            'nama_rs'               => Request()->nama_rs,
            'nama_dokter'           => Request()->nama_dokter,
            'nama_pasien'           => Request()->nama_pasien,
            'golda'                 => Request()->golda,
            'rhesus'                 => Request()->rhesus,
            'jenis_darah'                 => Request()->jenis_darah,
            'jumlah'                => Request()->jumlah,
            'upload_surat'          => $file_surat,
            'status_permohonan'     => "Belum Dikirim",
            'tanggal_permohonan'    => date('Y-m-d H:i:s')
        ];

        $this->M_PermohonanDarah->tambah($data);
        Alert::success('Berhasil', 'Data permohonan darah berhasil ditambah.');
        return redirect()->route('permohonan_darah');
    }

    public function edit_permohonan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Permohonan Darah',
            'sub_title'             => 'Edit Permohonan Darah',
            'data_web'              => $this->M_Website->detail(1),
            'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
            'stok'                  => $this->M_DarahMasuk->countGolJenisDarah('Sudah Masuk'),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'detail'                => $this->M_PermohonanDarah->detail($id_permohonan_darah)
        ];

        return view('rumah_sakit.permohonan_darah.v_edit', $data);
    }

    public function proses_edit_permohonan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_rs'           => 'required',
            'nama_dokter'       => 'required',
            'nama_pasien'       => 'required',
            'golda'             => 'required',
            'rhesus'             => 'required',
            'jenis_darah'             => 'required',
            'jumlah'            => 'required|numeric',
            'upload_surat'      => 'mimes:pdf|max:5048',
        ], [
            'nama_rs.required'          => 'Nama Rumah Sakit harus diisi!',
            'nama_dokter.required'      => 'Nama Dokter harus diisi!',
            'nama_pasien.required'      => 'Nama Pasien harus diisi!',
            'golda.required'            => 'Golongan Darah harus diisi!',
            'rhesus.required'            => 'Rhesus harus diisi!',
            'jenis_darah.required'            => 'Jenis Darah harus diisi!',
            'jumlah.required'           => 'Jumlah (Kantong) harus diisi!',
            'jumlah.numeric'            => 'Jumlah (Kantong) harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);

        $detail = $this->M_PermohonanDarah->detail($id_permohonan_darah);

        if (Request()->upload_surat <> "") {
            if ($detail->upload_surat <> "") {
                unlink(public_path($this->public_path) . '/' . $detail->upload_surat);
            }

            $file = Request()->upload_surat;
            $file_surat = date('mdYHis') . ' ' . Request()->nama_rs . '.' . $file->extension();
            $file->move(public_path($this->public_path), $file_surat);

            $data = [
                'id_permohonan_darah'   => $id_permohonan_darah,
                'nama_rs'               => Request()->nama_rs,
                'nama_dokter'           => Request()->nama_dokter,
                'nama_pasien'           => Request()->nama_pasien,
                'golda'                 => Request()->golda,
                'rhesus'                 => Request()->rhesus,
                'jenis_darah'                 => Request()->jenis_darah,
                'jumlah'                => Request()->jumlah,
                'upload_surat'          => $file_surat,
            ];
        } else {
            $data = [
                'id_permohonan_darah'   => $id_permohonan_darah,
                'nama_rs'               => Request()->nama_rs,
                'nama_dokter'           => Request()->nama_dokter,
                'nama_pasien'           => Request()->nama_pasien,
                'golda'                 => Request()->golda,
                'rhesus'                 => Request()->rhesus,
                'jenis_darah'                 => Request()->jenis_darah,
                'jumlah'                => Request()->jumlah,
            ];
        }

        $this->M_PermohonanDarah->edit($data);
        Alert::success('Berhasil', 'Data permohonan darah berhasil diedit.');
        return redirect()->route('permohonan_darah');
    }

    public function batal_permohonan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $detail = $this->M_PermohonanDarah->detail($id_permohonan_darah);

        if ($detail->upload_surat <> "") {
            unlink(public_path($this->public_path) . '/' . $detail->upload_surat);
        }

        $this->M_PermohonanDarah->hapus($id_permohonan_darah);
        Alert::success('Berhasil', 'Permohonan darah berhasil dibatalkan.');
        return back();
    }

    public function kirim_permohonan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_permohonan_darah'   => $id_permohonan_darah,
            'status_permohonan'     => 'Menunggu Proses',
            'tanggal_permohonan'    => date('Y-m-d H:i:s')
        ];

        $this->M_PermohonanDarah->edit($data);
        Alert::success('Berhasil', 'Data permohonan darah berhasil dikirim.');
        return redirect()->route('permohonan_darah');
    }

    public function terima_permohonan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_permohonan_darah'   => $id_permohonan_darah,
            'status_permohonan'     => 'Diterima',
        ];

        $this->M_PermohonanDarah->edit($data);
        Alert::success('Berhasil', 'Data darah berhasil diterima.');
        return redirect()->route('permohonan_darah');
    }

    public function riwayat_permohonan_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Riwayat Permohonan Darah',
            'sub_title'             => 'Data Riwayat Permohonan Darah',
            'data_web'              => $this->M_Website->detail(1),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'data_permohonan_darah' => $this->M_PermohonanDarah->get_data_user(Session()->get('id_user')),
            'data_darah_keluar'     => $this->M_DarahKeluar->get_data()
        ];

        return view('rumah_sakit.permohonan_darah.v_riwayat', $data);
    }

    // Admin
    public function distribusi_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Distribusi Darah',
            'sub_title'             => 'Data Distribusi Darah',
            'data_web'              => $this->M_Website->detail(1),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'data_distribusi_darah' => $this->M_PermohonanDarah->get_data()
        ];

        return view('admin.distribusi_darah.v_index', $data);
    }

    public function tambah_distribusi_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Distribusi Darah',
            'sub_title'             => 'Tambah Distribusi Darah',
            'data_web'              => $this->M_Website->detail(1),
            'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
            'stok'                  => $this->M_DarahMasuk->countGolJenisDarah('Sudah Masuk'),
            'user'                  => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.distribusi_darah.v_tambah', $data);
    }

    public function proses_tambah_distribusi_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_rs'           => 'required',
            'nama_dokter'       => 'required',
            'nama_pasien'       => 'required',
            'golda'             => 'required',
            'rhesus'            => 'required',
            'jenis_darah'       => 'required',
            'jumlah'            => 'required|numeric',
            'upload_surat'      => 'required|mimes:pdf|max:5048',
        ], [
            'nama_rs.required'          => 'Nama Rumah Sakit harus diisi!',
            'nama_dokter.required'      => 'Nama Dokter harus diisi!',
            'nama_pasien.required'      => 'Nama Pasien harus diisi!',
            'golda.required'            => 'Golongan Darah harus diisi!',
            'rhesus.required'           => 'Rhesus harus diisi!',
            'jenis_darah.required'      => 'Jenis Darah harus diisi!',
            'jumlah.required'           => 'Jumlah (Kantong) harus diisi!',
            'jumlah.numeric'            => 'Jumlah (Kantong) harus diisi!',
            'upload_surat.required'     => 'Surat harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);

        $stok = $this->M_DarahMasuk->countGolJenisDarah('Sudah Masuk');
        $golda = Request()->golda;
        $rhesus = Request()->rhesus;
        $jumlah = Request()->jumlah;
        $jenisDarah = Request()->jenis_darah;

        if ($golda == 'A' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['a+segar']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['a+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['a+baru']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['a+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['a+simpan']) {
                    // ->autoClose(30000)
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['a+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'B' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['b+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['b+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['b+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['b+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['b+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['b+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'AB' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['ab+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['ab+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['ab+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['ab+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['ab+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['ab+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'O' && $rhesus == 'Positif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['o+segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Segar stok tersisa ' . $stok['o+segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['o+baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Baru stok tersisa ' . $stok['o+baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['o+simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Positif dan Jenis Darah Simpan stok tersisa ' . $stok['o+simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'A' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['a-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['a-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['a-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['a-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['a-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah A dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['a-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'B' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['b-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['b-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['b-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['b-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['b-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah B dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['b-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'AB' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['ab-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['ab-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['ab-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['ab-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['ab-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah AB dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['ab-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        } elseif ($golda == 'O' && $rhesus == 'Negatif') {

            if ($jenisDarah === 'Darah Segar') {
                if ($jumlah > $stok['o-segar']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Segar stok tersisa ' . $stok['o-segar'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Baru') {
                if ($jumlah > $stok['o-baru']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Baru stok tersisa ' . $stok['o-baru'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
            if ($jenisDarah === 'Darah Simpan') {
                if ($jumlah > $stok['o-simpan']) {
                    Alert::error('Gagal', 'Anda menginput jumlah ' . $jumlah . ' kantong sedangkan Golongan darah O dengan Rhesus Negatif dan Jenis Darah Simpan stok tersisa ' . $stok['o-simpan'] . ' kantong.')->autoClose(30000);
                    return redirect()->back();
                }
            }
        }

        $file = Request()->upload_surat;
        $file_surat = date('mdYHis') . ' ' . Request()->nama_rs . '.' . $file->extension();
        $file->move(public_path($this->public_path), $file_surat);

        $data = [
            'id_user'               => Session()->get('id_user'),
            'nama_rs'               => Request()->nama_rs,
            'nama_dokter'           => Request()->nama_dokter,
            'nama_pasien'           => Request()->nama_pasien,
            'golda'                 => Request()->golda,
            'rhesus'                => Request()->rhesus,
            'jenis_darah'           => Request()->jenis_darah,
            'jumlah'                => Request()->jumlah,
            'upload_surat'          => $file_surat,
            'status_permohonan'     => "Menunggu Proses",
            'tanggal_permohonan'    => date('Y-m-d H:i:s')
        ];

        $this->M_PermohonanDarah->tambah($data);
        Alert::success('Berhasil', 'Data permohonan darah berhasil ditambah.');
        return redirect()->route('distribusi_darah');
    }

    public function riwayat_distribusi_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Distribusi Darah',
            'sub_title'             => 'Riwayat Distribusi Darah',
            'data_web'              => $this->M_Website->detail(1),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'data_distribusi_darah' => $this->M_PermohonanDarah->get_data(),
            'data_darah_keluar'     => $this->M_DarahKeluar->get_data()
        ];

        return view('admin.distribusi_darah.v_riwayat', $data);
    }

    public function keluarkan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'                 => 'Distribusi Darah',
            'sub_title'             => 'Form Keluarkan Darah',
            'data_web'              => $this->M_Website->detail(1),
            'user'                  => $this->M_User->detail(Session()->get('id_user')),
            'detail'                => $this->M_PermohonanDarah->detail($id_permohonan_darah),
            'data_darah'            => $this->M_DarahMasuk->get_data(),
            'data_darah_keluar'     => $this->M_DarahKeluar->get_data_permohonan($id_permohonan_darah)
        ];

        return view('admin.distribusi_darah.v_keluarkan_darah', $data);
    }

    public function proses_keluarkan_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $darah_masuk = $this->M_DarahMasuk->detail(Request()->id_darah_masuk);

        $data_darah_keluar = [
            'id_darah'              => $darah_masuk->id_darah,
            'id_permohonan_darah'   => $id_permohonan_darah,
            'tanggal_keluar'        => date('Y-m-d H:i:s')
        ];

        $this->M_DarahKeluar->tambah($data_darah_keluar);
        $this->M_DarahMasuk->hapus($darah_masuk->id_darah_masuk);
        Alert::success('Berhasil', 'Darah telah dikeluarkan.');
        return back();
    }

    public function kirim_distribusi_darah($id_permohonan_darah)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_permohonan_darah'   => $id_permohonan_darah,
            'status_permohonan'     => 'Dikirim',
        ];

        $this->M_PermohonanDarah->edit($data);
        Alert::success('Berhasil', 'Darah telah didisribusikan.');
        return redirect()->route('distribusi_darah');
    }

    public function hapus_darah_keluar($id_darah_keluar)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $darah_keluar = $this->M_DarahKeluar->detail($id_darah_keluar);

        $data_darah_masuk = [
            'id_darah'  => $darah_keluar->id_darah,
            'id_user'   => Session()->get('id_user')
        ];
        $this->M_DarahMasuk->tambah($data_darah_masuk);

        $this->M_DarahKeluar->hapus($id_darah_keluar);
        Alert::success('Berhasil', 'Darah batal dikeluarkan.');
        return back();
    }

    public function cetak_distribusi_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Rekap Distribusi Darah',
            'data_web'      => $this->M_Website->detail(1),
            'data_darah'    => $this->M_DarahKeluar->get_data_tanggal(Request()->tanggal_mulai, Request()->tanggal_akhir)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_distribusi_darah', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function cetak_invoice_distribusi($id_darah_keluar)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Invoice Distribusi Darah',
            'data_web'      => $this->M_Website->detail(1),
            'data_darah'    => $this->M_DarahKeluar->get_darah_keluar($id_darah_keluar)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_invoice_distribusi', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }
}

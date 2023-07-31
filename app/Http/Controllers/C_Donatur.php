<?php

namespace App\Http\Controllers;

use App\Models\M_Anggota;
use App\Models\M_Donor;
use App\Models\M_Kuesioner;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Http\Request;

class C_Donatur extends Controller
{

    private $M_Website, $M_User, $M_Anggota, $M_Donor, $M_Kuesioner;

    public function __construct()
    {
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
        $this->M_Anggota = new M_Anggota();
        $this->M_Donor = new M_Donor();
        $this->M_Kuesioner = new M_Kuesioner();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (Request()->nik == null) {
            $data = [
                'title'     => 'Daftar',
                'sub_title' => 'Daftar Donor',
                'data_web'  => $this->M_Website->detail(1),
                'data'      => null,
                'user'      => $this->M_User->detail_user_donatur(Session()->get('id_user')),
            ];
        } else {
            $nik = $this->M_Anggota->cek_nik(Request()->nik);
            if (!$nik) {
                return redirect()->route('daftar_donor')->with('not_found', 'NIK tidak ditemukan!');
            }
            $data = [
                'title'     => 'Daftar',
                'sub_title' => 'Daftar Donor',
                'data_web'  => $this->M_Website->detail(1),
                'data'      => $nik,
                'user'      => $this->M_User->detail_user_donatur(Session()->get('id_user')),
            ];
        }
        // dd($data['data']);
        return view('donatur.v_daftar_donor', $data);
    }

    public function submit_kuisioner()
    {

        // dd(Request()->all());
        $anggota = $this->M_Anggota->cek_nik(Request()->nik);
        // dd($anggota->tanggal_donor_kembali);
        if ($anggota) {
            if (date('Y-m-d') < $anggota->tanggal_donor_kembali) {
                return redirect()->route('daftar_donor')->with('gagal', 'Anda belum waktunya untuk daftar donor kembali. Daftar kembali pada tanggal ' . date('d m Y', strtotime($anggota->tanggal_donor_kembali)));
            }
        }

        // dd(Request());
        Request()->validate([
            'nik'                       => 'required',
            'nama'                      => 'required',
            // 'jenis_kelamin'             => 'required',
            'alamat'                    => 'required',
            'kecamatan'                 => 'required',
            'kabupaten'                 => 'required',
        ], [
            'nik.required'              => 'NIK Anggota harus diisi!',
            'nama.required'             => 'Nama Anggota harus diisi!',
            // 'jenis_kelamin.required'    => 'Jenis Kelamin harus diisi!',
            'alamat.required'           => 'Alamat harus diisi!',
            'kecamatan.required'        => 'Kecamatan harus diisi!',
            'kabupaten.required'        => 'Kabupaten harus diisi!',
        ]);
        // dd(Request()->all());
        // $count = 0;
        // for ($i = 1; $i <= 25; $i++) {
        //     $count = $count + Request()->p[$i];
        // }
        // jika semua dijawab tidak
        // if ($count <= 0) {
        $data = [
            'nik'                   => Request()->nik,
            'nama_anggota'          => Request()->nama,
            'jenis_kelamin'         => Request()->jenis_kelamin,
            'no_wa'                 => Request()->no_wa,
            'alamat'                => Request()->alamat,
            'kecamatan'             => Request()->kecamatan,
            'kabupaten'             => Request()->kabupaten,
            'status_anggota'        => 'Mandiri',
            'tanggal_donor_kembali' => date('Y-m-d'),
            // 'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
        ];

        $data_user = [
            'id_user'       => Session()->get('id_user'),
            'alamat_user'   => Request()->alamat,
            'kecamatan'     => Request()->kecamatan,
            'kabupaten'     => Request()->kabupaten,
            'nomor_telepon' => Request()->no_wa
        ];

        $this->M_User->edit($data_user);

        $cek_nik = $this->M_Anggota->cek_nik(Request()->nik);
        $data_terakhir = $cek_nik;

        // jika nik tidak ditemukan maka tambah data sebagai anggota baru
        if (!$cek_nik) {
            $this->M_Anggota->tambah($data);
            $data_terakhir = $this->M_Anggota->data_terakhir();
        } else {
            // jika nik ditemukan maka update data anggota tersebut
            // kemudian cek apakah pendonoran sebelumnya sudah di proses
            $cek_status_donor = $this->M_Donor->cek_status_donor($data_terakhir->id_anggota);
            if ($cek_status_donor->status_donor == 'Proses') {
                return redirect()->route('riwayat_donor')->with('gagal', 'Maaf Pendaftaran Donor Anda Sebelumnya Belum Di Proses. Silahkan Tunggu Sampai Di Proses Terlebih Dahulu!.');
            }
            $data2 = [
                'id_anggota'            => $data_terakhir->id_anggota,
                'nik'                   => Request()->nik,
                'nama_anggota'          => Request()->nama,
                'jenis_kelamin'         => Request()->jenis_kelamin,
                'no_wa'                 => Request()->no_wa,
                'alamat'                => Request()->alamat,
                'kecamatan'             => Request()->kecamatan,
                'kabupaten'             => Request()->kabupaten,
                'status_anggota'        => 'Mandiri',
                'tanggal_donor_kembali' => date('Y-m-d'),
                // 'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
            ];
            $this->M_Anggota->edit($data2);
        }

        $nomor_antrian = $this->M_Donor->get_nomor_antrian();
        $data_donor = [
            'id_anggota'                => $data_terakhir->id_anggota,
            'tanggal_donor'             => date('Y-m-d H:i:s'),
            'status_donor'              => 'Proses',
            'hasil_kusioner'            => 'Proses',
            // 'deskripsi_hasil_kusioner'  => 'Lolos kusioner',
            'nomor_antrian'             => $nomor_antrian
        ];
        $this->M_Donor->tambah($data_donor);
        $donor = $this->M_Donor->data_terakhir();
        $data_kuesioner = [
            'id_donor'    => $donor->id_donor,
            'pertanyaan_1'  => Request()->p[1],
            'pertanyaan_2'  => Request()->p[2],
            'pertanyaan_3'  => Request()->p[3],
            'pertanyaan_4'  => Request()->p[4],
            'pertanyaan_5'  => Request()->p[5],
            'pertanyaan_6'  => Request()->p[6],
            'pertanyaan_7'  => Request()->p[7],
            'pertanyaan_8'  => Request()->p[8],
            'pertanyaan_9'  => Request()->p[9],
            'pertanyaan_10'  => Request()->p[10],
            'pertanyaan_11'  => Request()->p[11],
            'pertanyaan_12'  => Request()->p[12],
            'pertanyaan_13'  => Request()->p[13],
            'pertanyaan_14'  => Request()->p[14],
            'pertanyaan_15'  => Request()->p[15],
            'pertanyaan_16'  => Request()->p[16],
            'pertanyaan_17'  => Request()->p[17],
            'pertanyaan_18'  => Request()->p[18],
            'pertanyaan_19'  => Request()->p[19],
            'pertanyaan_20'  => Request()->p[20],
            'pertanyaan_21'  => Request()->p[21],
            'pertanyaan_22'  => Request()->p[22],
            'pertanyaan_23'  => Request()->p[23],
            'pertanyaan_24'  => Request()->p[24],
            'pertanyaan_25'  => Request()->p[25],
            'pertanyaan_26'  => Request()->p[26],
            'pertanyaan_27'  => Request()->p[27],
            'pertanyaan_28'  => Request()->p[28],
            'pertanyaan_29'  => Request()->p[29],
            'pertanyaan_30'  => Request()->p[30],
            'pertanyaan_31'  => Request()->p[31],
            'pertanyaan_32'  => Request()->p[32],
            'pertanyaan_33'  => Request()->p[33],
            'pertanyaan_34'  => Request()->p[34],
            'pertanyaan_35'  => Request()->p[35],
            'pertanyaan_36'  => Request()->p[36],
            'pertanyaan_37'  => Request()->p[37],
            'pertanyaan_38'  => Request()->p[38],
            'pertanyaan_39'  => Request()->p[39],
            'pertanyaan_40'  => Request()->p[40],
            'pertanyaan_41'  => Request()->p[41],
            'bulan_kehamilan'   => Request()->bulan_kehamilan
        ];
        $this->M_Kuesioner->tambah($data_kuesioner);

        return redirect()->to('hasil_donor/' . Request()->nik)->with('berhasil', 'Pengisian Kuisioner Donor Berhasil. Silahkan Tunggu Informasi Selanjutnya!');
        // }
        // jika ada 1 jawaban saja yg ya
        // return redirect()->route('daftar_donor')->with('gagal', 'Maaf Donor Darah Gagal. Anda Kurang Memenuhi Persyaratan!');
    }

    public function riwayat_donor()
    {
        $user_donatur = $this->M_User->detail_user_donatur(Session()->get('id_user'));

        $cek_nik = $this->M_Anggota->cek_nik($user_donatur->nik);

        if ($cek_nik) {
            $data = [
                'title'     => 'Riwayat',
                'sub_title' => 'Riwayat Donor',
                'data_web'  => $this->M_Website->detail(1),
                'detail'    => $cek_nik,
                'data'      => $this->M_Donor->get_all_by_anggota($cek_nik->id_anggota),
                'user'      => $this->M_User->detail_user_donatur(Session()->get('id_user')),
            ];
            return view('donatur.v_riwayat_donor', $data);
        } else {
            return redirect()->route('dashboard')->with('error', 'Anda belum pernah melakukan donor.');
        }
    }

    public function lihat_kuesioner($id)
    {
        $data = [
            'title'         => 'Kuesioner & Kesehatan',
            'sub_title'     => 'Detail Kuesioner dan Hasil Cek Kesehatan',
            'data_web'      => $this->M_Website->detail(1),
            'data'          => $this->M_Kuesioner->detail($id),
            'data_petugas'  => $this->M_User->getPetugasByDonor($id),
            'data_kuesioner'  => $this->M_User->getPetugasKuesionerByDonor($id),
            'user'          => $this->M_User->detail_user_donatur(Session()->get('id_user')),
        ];

        // dd($data['data_petugas']);
        return view('donatur.v_detail_kuesioner', $data);
    }
}

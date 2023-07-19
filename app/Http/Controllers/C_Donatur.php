<?php

namespace App\Http\Controllers;

use App\Models\M_Anggota;
use App\Models\M_Donor;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Http\Request;

class C_Donatur extends Controller
{

    private $M_Website, $M_User, $M_Anggota, $M_Donor;

    public function __construct()
    {
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
        $this->M_Anggota = new M_Anggota();
        $this->M_Donor = new M_Donor();
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

        $anggota = $this->M_Anggota->cek_nik(Request()->nik);
        // dd($anggota->tanggal_donor_kembali);
        if (date('Y-m-d') < $anggota->tanggal_donor_kembali) {
            return redirect()->route('daftar_donor')->with('gagal', 'Anda belum waktunya untuk daftar donor kembali. Daftar kembali pada tanggal ' . date('d m Y', strtotime($anggota->tanggal_donor_kembali)));
        }

        // dd(Request());
        Request()->validate([
            'nik'                       => 'required',
            'nama'                      => 'required',
            // 'jenis_kelamin'             => 'required',
            'alamat'                    => 'required',
        ], [
            'nik.required'              => 'NIK Anggota harus diisi!',
            'nama.required'             => 'Nama Anggota harus diisi!',
            // 'jenis_kelamin.required'    => 'Jenis Kelamin harus diisi!',
            'alamat.required'           => 'Alamat harus diisi!',
        ]);
        // dd(Request()->all());
        $count = 0;
        for ($i = 1; $i <= 25; $i++) {
            $count = $count + Request()->p[$i];
        }
        // jika semua dijawab tidak
        if ($count <= 0) {
            $data = [
                'nik'                   => Request()->nik,
                'nama_anggota'          => Request()->nama,
                'jenis_kelamin'         => Request()->jenis_kelamin,
                'no_wa'                 => Request()->no_wa,
                'alamat'                => Request()->alamat,
                'status_anggota'        => 'Mandiri',
                'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime(date('Y-m-d')))),
            ];
            $cek_nik = $this->M_Anggota->cek_nik(Request()->nik);
            $data_terakhir = $cek_nik;
            if (!$cek_nik) {
                $this->M_Anggota->tambah($data);
                $data_terakhir = $this->M_Anggota->data_terakhir();
            }
            $nomor_antrian = $this->M_Donor->get_nomor_antrian();
            $data_donor = [
                'id_anggota'                => $data_terakhir->id_anggota,
                'tanggal_donor'             => date('Y-m-d H:i:s'),
                'status_donor'              => 'Proses',
                'hasil_kusioner'            => 'Lolos',
                'deskripsi_hasil_kusioner'  => 'Lolos kusioner',
                'nomor_antrian'             => $nomor_antrian
            ];
            $this->M_Donor->tambah($data_donor);
            return redirect()->to('hasil_donor/' . Request()->nik)->with('berhasil', 'Hasil Kuisioner Donor Berhasil. Silahkan Tunggu Informasi Selanjutnya!');
        }
        // jika ada 1 jawaban saja yg ya
        return redirect()->route('daftar_donor')->with('gagal', 'Maaf Donor Darah Gagal. Anda Kurang Memenuhi Persyaratan!');
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
            return redirect()->route('dashboard')->with('error', 'NIK tidak ditemukan. Mungkin anda belum pernah melakukan donor.');
        }
    }
}

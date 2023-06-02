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
    }

    public function index()
    {
        $data = [
            'title'     => 'Daftar',
            'sub_title' => 'Daftar Donor',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('donatur.v_daftar_donor', $data);
    }

    public function submit_kuisioner()
    {
        Request()->validate([
            'nama'                      => 'required',
            'jenis_kelamin'             => 'required',
            'alamat'                    => 'required',
        ], [
            'nama.required'             => 'Nama Anggota harus diisi!',
            'jenis_kelamin.required'    => 'Jenis Kelamin harus diisi!',
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
                'nama_anggota'          => Request()->nama,
                'jenis_kelamin'         => Request()->jenis_kelamin,
                'alamat'                => Request()->alamat,
                'status_anggota'        => 'Mandiri',
                'tanggal_donor_kembali' => date('Y-m-d'),
            ];
            $this->M_Anggota->tambah($data);
            $data_terakhir = $this->M_Anggota->data_terakhir();
            $data_donor = [
                'id_anggota'                => $data_terakhir->id_anggota,
                'tanggal_donor'             => date('Y-m-d H:i:s'),
                'status_donor'              => 'Ready',
                'hasil_kusioner'            => 'Lolos',
                'deskripsi_hasil_kusioner'  => 'Lolos kusioner'
            ];
            $this->M_Donor->tambah($data_donor);
            return redirect()->route('daftar_donor')->with('berhasil', 'Daftar Donor Berhasil. Silahkan Tunggu Informasi Selanjutnya!');
        }
        // jika ada 1 jawaban saja yg ya
        return redirect()->route('daftar_donor')->with('gagal', 'Daftar Donor Gagal. Anda Kurang Memenuhi Persyaratan!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Http\Request;

class C_Donatur extends Controller
{

    private $M_Website, $M_User;

    public function __construct()
    {
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
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
        $count = 0;
        for ($i = 1; $i <= 25; $i++) {
            $count = $count + Request()->p[$i];
        }
        // jika semua dijawab tidak
        if ($count <= 0) {
            return redirect()->route('daftar_donor')->with('berhasil', 'Daftar Donor Berhasil. Silahkan Tunggu Informasi Selanjutnya!');
        }
        // jika ada 1 jawaban saja yg ya
        return redirect()->route('daftar_donor')->with('gagal', 'Daftar Donor Gagal. Anda Kurang Memenuhi Persyaratan!');
    }
}

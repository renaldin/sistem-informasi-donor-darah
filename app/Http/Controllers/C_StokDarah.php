<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Darah;
use App\Models\M_DarahMasuk;
use RealRashid\SweetAlert\Facades\Alert;

class C_StokDarah extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Darah;
    private $M_DarahMasuk;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Darah = new M_Darah();
        $this->M_DarahMasuk = new M_DarahMasuk();
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
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_online', $data);
    }

    public function tambah_darah_offline()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Data Stok Darah',
            'sub_title'     => 'Tambah Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.stok_darah.v_tambah_offline', $data);
    }
}

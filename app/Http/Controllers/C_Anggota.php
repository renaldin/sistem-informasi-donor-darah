<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Anggota;
use App\Models\M_Darah;
use RealRashid\SweetAlert\Facades\Alert;

class C_Anggota extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Anggota;
    private $M_Darah;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Anggota = new M_Anggota();
        $this->M_Darah = new M_Darah();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Anggota',
            'sub_title'     => 'Data Anggota',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_anggota'  => $this->M_Anggota->get_data(),
            'data_darah'    => $this->M_Darah->get_data()
        ];

        return view('admin.anggota.v_index', $data);
    }
}

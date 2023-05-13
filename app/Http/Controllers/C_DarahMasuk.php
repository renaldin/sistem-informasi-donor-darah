<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Darah;
use App\Models\M_DarahMasuk;
use RealRashid\SweetAlert\Facades\Alert;

class C_DarahMasuk extends Controller
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
            'title'         => 'Data Darah Masuk',
            'sub_title'     => 'Data Darah Masuk',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('admin.darah.v_index', $data);
    }
}

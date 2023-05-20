<?php

namespace App\Http\Controllers;

use App\Models\M_DarahMasuk;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Http\Request;

class C_LandingPage extends Controller
{

    private $M_Website, $M_User, $M_DarahMasuk;

    public function __construct()
    {
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
        $this->M_DarahMasuk = new M_DarahMasuk();
    }

    public function index()
    {
        $data = [
            'title'         => 'Home',
            'sub_title'     => 'Landing Page',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('landingpage.v_index', $data);
    }
}

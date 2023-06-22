<?php

namespace App\Http\Controllers;

use App\Models\M_DarahMasuk;
use App\Models\M_Event;
use App\Models\M_PermohonanDarah;
use App\Models\M_User;
use App\Models\M_Website;
use Illuminate\Http\Request;

class C_LandingPage extends Controller
{

    private $M_Website, $M_User, $M_DarahMasuk, $M_Event, $M_PermohonanDarah;

    public function __construct()
    {
        $this->M_Website = new M_Website();
        $this->M_User = new M_User();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_Event = new M_Event();
        $this->M_PermohonanDarah = new M_PermohonanDarah();
    }

    public function index()
    {
        $data = [
            'title'             => 'Home',
            'sub_title'         => 'Landing Page',
            'data_web'          => $this->M_Website->detail(1),
            'user'              => $this->M_User->detail(Session()->get('id_user')),
            'darah_masuk'       => $this->M_DarahMasuk->getDataPerBulan(),
            'event'             => $this->M_Event->getEventPerbulan(),
            'permohonan_darah'  => $this->M_PermohonanDarah->getPermohonanPerbulan(),
            'gol'               => $this->M_DarahMasuk->countGol('Sudah Masuk'),
            'all_event'             => $this->M_Event->get_all_data()
        ];

        // dd($data['darah_masuk']);

        return view('landingpage.v_index', $data);
    }
}

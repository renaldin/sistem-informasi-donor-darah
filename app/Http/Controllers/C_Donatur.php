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
            'sub_title' => 'Dashboard',
            'data_web'  => $this->M_Website->detail(1),
            'user'      => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('donatur.v_daftar_donor', $data);
    }
}

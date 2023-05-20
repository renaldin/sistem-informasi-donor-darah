<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Donatur extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Daftar',
            // 'data_web'  => $this->M_Website->detail(1),
        ];

        return view('donatur.v_daftar_donor', $data);
    }
}

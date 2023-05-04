<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;

class C_Dashboard extends Controller
{

    private $M_User;
    private $M_Website;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
    }

    public function index()
    {

        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        if (Session()->get('role') === 'Admin') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'dataWeb'               => $this->M_Website->detail(1),
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'jumlahUser'            => $this->M_User->jumlahUser(),
            ];
            return view('admin.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Donatur') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'dataWeb'               => $this->M_Website->detail(1),
            ];
            return view('donatur.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Event') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'dataWeb'               => $this->M_Website->detail(1),
            ];
            return view('event.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Petugas Kesehatan') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'dataWeb'               => $this->M_Website->detail(1),
            ];
            return view('petugas_kesehatan.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Rumah Sakit') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'dataWeb'               => $this->M_Website->detail(1),
            ];
            return view('rumah_sakit.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Pusat PMI') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'dataWeb'               => $this->M_Website->detail(1),
            ];
            return view('pusat_pmi.v_dashboard', $data);
        }
    }
}

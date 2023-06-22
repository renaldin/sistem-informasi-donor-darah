<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_DarahMasuk;
use App\Models\M_Event;
use App\Models\M_PermohonanDarah;
use App\Models\M_Anggota;

class C_Dashboard extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_DarahMasuk;
    private $M_Event;
    private $M_PermohonanDarah;
    private $M_Anggota;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_Event = new M_Event();
        $this->M_PermohonanDarah = new M_PermohonanDarah();
        $this->M_Anggota = new M_Anggota();
    }

    public function index()
    {

        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        if (Session()->get('role') === 'Admin') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'             => 'Dashboard',
                'data_web'              => $this->M_Website->detail(1),
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'jumlahUser'            => $this->M_User->jumlah_user(),
                'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
                'gol_belum_masuk'       => $this->M_DarahMasuk->countGol('Belum Masuk'),
                'event'                 => $this->M_Event->countEvent('Aktif'),
                'event_tidak_aktif'     => $this->M_Event->countEvent('Tidak Aktif'),
                'permohonan_darah'      => $this->M_PermohonanDarah->countPermohonan('Menunggu Proses'),
                'anggota'               => $this->M_Anggota->jumlah(),
            ];
            return view('admin.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Donatur') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return view('donatur.v_dashboard', $data);
            // return redirect()->route('/')->with('berhasil', 'Login berhasil!');
            // return redirect()->to('');
        } elseif (Session()->get('role') === 'Event') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return view('event.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Petugas Kesehatan') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return view('petugas_kesehatan.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Rumah Sakit') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return view('rumah_sakit.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Pusat PMI') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return view('pusat_pmi.v_dashboard', $data);
        }
    }
}

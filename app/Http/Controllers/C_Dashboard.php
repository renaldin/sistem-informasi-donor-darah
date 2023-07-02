<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_DarahMasuk;
use App\Models\M_DarahBuang;
use App\Models\M_DarahKeluar;
use App\Models\M_Event;
use App\Models\M_PermohonanDarah;
use App\Models\M_Anggota;

class C_Dashboard extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_DarahMasuk;
    private $M_DarahBuang;
    private $M_DarahKeluar;
    private $M_Event;
    private $M_PermohonanDarah;
    private $M_Anggota;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_DarahKeluar = new M_DarahKeluar();
        $this->M_DarahBuang = new M_DarahBuang();
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
                'gol_darah_buang'       => $this->M_DarahBuang->countGol(),
                'gol_darah_keluar'      => $this->M_DarahKeluar->countGol(),
                'event'                 => $this->M_Event->countEvent('Aktif'),
                'jumlah_rumah_sakit'    => $this->M_User->countUser('Rumah Sakit'),
                'permohonan_darah'      => $this->M_PermohonanDarah->countPermohonan('Menunggu Proses'),
                'anggota'               => $this->M_Anggota->jumlah(),
            ];
            return view('admin.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Donatur') {

            $user = $this->M_User->detail_user_donatur(Session()->get('id_user'));

            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $user,
                'data_web'               => $this->M_Website->detail(1),
                'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
                'anggota'                   => $this->M_Anggota->cek_nik($user->nik),
            ];
            return view('donatur.v_dashboard', $data);
            // return redirect()->route('/')->with('berhasil', 'Login berhasil!');
            // return redirect()->to('');
        } elseif (Session()->get('role') === 'Event') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail_user_event(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
                'event'               => $this->M_Event->get_data(),
            ];
            // dd(Session()->get('id_user'));
            return view('event.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Petugas Kesehatan') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
            ];
            return redirect()->route('antrian');
        } elseif (Session()->get('role') === 'Rumah Sakit') {
            $data = [
                'title'                 => 'Dashboard',
                'sub_title'              => 'Dashboard',
                'user'                  => $this->M_User->detail_user_rs(Session()->get('id_user')),
                'data_web'               => $this->M_Website->detail(1),
                'gol'                   => $this->M_DarahMasuk->countGol('Sudah Masuk'),
                'data_permohonan_darah' => $this->M_PermohonanDarah->get_data_user(Session()->get('id_user')),
            ];
            return view('rumah_sakit.v_dashboard', $data);
        }
    }
}

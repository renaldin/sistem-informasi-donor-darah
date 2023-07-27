<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_DarahMasuk;
use App\Models\M_DarahKeluar;
use App\Models\M_DarahBuang;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class C_Laporan extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_DarahMasuk;
    private $M_DarahKeluar;
    private $M_DarahBuang;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_DarahMasuk = new M_DarahMasuk();
        $this->M_DarahKeluar = new M_DarahKeluar();
        $this->M_DarahBuang = new M_DarahBuang();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Laporan',
            'sub_title'     => 'Laporan Darah Masuk',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('pusat_pmi.laporan.v_index', $data);
    }

    public function stok_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Laporan',
            'sub_title'     => 'Laporan Stok Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data()
        ];

        return view('pusat_pmi.laporan.v_stok_darah', $data);
    }

    public function darah_keluar()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Laporan',
            'sub_title'     => 'Laporan Darah Keluar',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahKeluar->get_data()
        ];

        return view('pusat_pmi.laporan.v_darah_keluar', $data);
    }

    public function darah_buang()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Laporan',
            'sub_title'     => 'Laporan Darah Buang',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahBuang->get_data()
        ];

        return view('pusat_pmi.laporan.v_darah_buang', $data);
    }

    public function cetak_darah_masuk()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Rekap Darah Masuk',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data_tanggal(Request()->tanggal_mulai, Request()->tanggal_akhir)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_darah_masuk', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function cetak_stok_darah()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Rekap Stok Darah',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahMasuk->get_data_tanggal(Request()->tanggal_mulai, Request()->tanggal_akhir)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_stok_darah', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function cetak_darah_keluar()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Rekap Darah Keluar',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahKeluar->get_data_tanggal(Request()->tanggal_mulai, Request()->tanggal_akhir)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_darah_keluar', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function cetak_darah_buang()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Rekap Darah Buang',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_darah'    => $this->M_DarahBuang->get_data_tanggal(Request()->tanggal_mulai, Request()->tanggal_akhir)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_darah_buang', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }
}

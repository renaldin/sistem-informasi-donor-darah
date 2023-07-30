<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Anggota;
use App\Models\M_Darah;
use App\Models\M_Donor;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use PDF;


class C_Antrian extends Controller
{
    private $M_User;
    private $M_Website;
    private $M_Anggota;
    private $M_Darah;
    private $M_Donor;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Anggota = new M_Anggota();
        $this->M_Darah = new M_Darah();
        $this->M_Donor = new M_Donor();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Antrian',
            'sub_title'     => 'Antrian Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_donor'    => $this->M_Donor->get_data()
        ];
        return view('petugas_kesehatan.antrian.v_index', $data);
    }

    public function cek_kesehatan($id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data_donor = $this->M_Donor->get_donor_by_id($id);
        if ($data_donor->hasil_kusioner == 'Proses') {
            return redirect()->back()->with('gagal', 'Anda Belum Memvalidasi Hasil Kuesioner.');
        }

        $data = [
            'title'         => 'Cek Kesehatan',
            'sub_title'     => 'Cek Kesehatan Anggota Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_donor'    => $this->M_Donor->get_donor_by_id($id)
        ];
        return view('petugas_kesehatan.antrian.v_cek_kesehatan', $data);
    }

    public function tamabah_data_kesehatan($id)
    {

        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'hb'                        => 'required',
            'tekanan_darah_sistole'     => 'required',
            'tekanan_darah_diastole'    => 'required',
            'berat_badan'               => 'required',
            'tinggi_badan'              => 'required',
            'denyut_nadi'               => 'required',
            'keadaan_umum'              => 'required',
        ], [
            'hb.required'                       => 'HB harus diisi!',
            'tekanan_darah_sistole.required'    => 'Tekanan Darah Sistole harus diisi!',
            'tekanan_darah_diastole.required'   => 'Tekanan Darah Diastole harus diisi!',
            'berat_badan.required'              => 'Berat Badan harus diisi!',
            'tinggi_badan.required'             => 'Tinggi Badan harus diisi!',
            'denyut_nadi.required'              => 'Denyut Nadi harus diisi!',
            'keadaan_umum.required'             => 'Keadaan Umum harus diisi!',
        ]);

        $data = [
            'id_donor'              => $id,
            'status_donor'          => Request()->catatan ? 'Gagal' : 'Ready',
            'hb'                    => Request()->hb,
            'tekanan_darah'         => Request()->tekanan_darah_sistole . '/' . Request()->tekanan_darah_diastole,
            'berat_badan'           => Request()->berat_badan,
            'tinggi_badan'          => Request()->tinggi_badan,
            'denyut_nadi'           => Request()->denyut_nadi,
            'keadaan_umum'          => Request()->keadaan_umum,
            'catatan_pendonor'      => Request()->catatan,
            'id_petugas_kesehatan'  => Session()->get('id_user')
        ];

        // update tanggal donor kembali jika cek kesehatan lolos
        $anggota = $this->M_Donor->detail($id);
        if (Request()->catatan == null || Request()->catatan == '') {
            $data_anggota = [
                'id_anggota'            => $anggota->id_anggota,
                'tanggal_donor_kembali' => date('Y-m-d', strtotime('+60 days', strtotime($anggota->tanggal_donor_kembali)))
            ];
            $this->M_Anggota->edit($data_anggota);
        }

        $get_anggota = $this->M_Anggota->detail($anggota->id_anggota);
        $update_golda = [
            'nik'       => $get_anggota->nik,
            'gol_darah' => Request()->golda
        ];
        $this->M_User->edit_golda($update_golda);

        $this->M_Donor->edit($data);

        Alert::success('Berhasil', 'Data Kesehatan Berhasil ditambah.');
        return redirect()->route('antrian');
    }

    public function lihat_data_kesehatan($id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Detail',
            'sub_title'     => 'Detail Kuesioner dan Kesehatan Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_donor'    => $this->M_Donor->get_donor_by_id($id)
        ];
        return view('petugas_kesehatan.antrian.v_lihat_kesehatan', $data);
    }

    public function validasi_anggota($id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_donor' => $id,
            'status_donor' => 'Ready'
        ];

        $this->M_Donor->edit($data);
        Alert::success('Berhasil', 'Berhasil Melakukan Validasi.');
        return redirect()->route('antrian');
    }

    public function detail_kuesioner_donor($id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Kuesioner',
            'sub_title'     => 'Kuesioner Pendonor',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_donor'    => $this->M_Donor->get_donor_by_id($id)
        ];

        return view('petugas_kesehatan.antrian.v_detail_kuesioner', $data);
    }

    public function validasi_kuesioner($id)
    {
        $data = [
            'id_donor'          => $id,
            'hasil_kusioner'    => 'Lolos',
            'id_petugas_kuesioner'  => Session()->get('id_user')
        ];
        $this->M_Donor->edit($data);
        Alert::success('Berhasil', 'Berhasil Melakukan Validasi Kuesioner.');
        return redirect()->back();
    }

    public function kuesioner_tidak_valid($id)
    {
        $data = [
            'id_donor'                  => $id,
            'status_donor'              => 'Gagal',
            'hasil_kusioner'            => 'Tidak Lolos',
            'deskripsi_hasil_kusioner'  => Request()->deskripsi_hasil_kusioner,
            'id_petugas_kuesioner'      => Session()->get('id_user')
        ];
        $this->M_Donor->edit($data);
        Alert::success('Berhasil', 'Berhasil Melakukan Validasi Kuesioner.');
        return redirect()->back();
    }

    public function antrian_donatur() // page admin
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Antrian',
            'sub_title'     => 'Antrian Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_donor'    => $this->M_Donor->get_data()
        ];
        return view('admin.antrian.v_index', $data);
    }

    public function detail_antrian($id) // page admin
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Detail',
            'sub_title'     => 'Detail Kuesioner dan Kesehatan Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_petugas'  => $this->M_User->getPetugasByDonor($id),
            'data_kuesioner'  => $this->M_User->getPetugasKuesionerByDonor($id),
            'data_donor'    => $this->M_Donor->get_donor_by_id($id)
        ];
        return view('admin.antrian.v_detail_antrian', $data);
    }

    public function cetak_antrian($id)
    {
        $data = [
            'title'         => 'Detail',
            'sub_title'     => 'Detail Kuesioner dan Kesehatan Donatur',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_petugas'  => $this->M_User->getPetugasByDonor($id),
            'data_kuesioner'  => $this->M_User->getPetugasKuesionerByDonor($id),
            'data_donor'    => $this->M_Donor->get_donor_by_id($id)
        ];

        $pdf = PDF::loadview('cetak/v_cetak_antrian', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }
}

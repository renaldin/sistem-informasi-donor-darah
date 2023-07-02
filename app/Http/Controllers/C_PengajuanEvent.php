<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Event;
use App\Models\M_Darah;
use App\Models\M_Donor;
use App\Models\M_Anggota;
use App\Models\M_DarahMasuk;
use Illuminate\Contracts\Session\Session;
use RealRashid\SweetAlert\Facades\Alert;

class C_PengajuanEvent extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Event;
    private $M_Darah;
    private $M_Donor;
    private $M_Anggota;
    private $M_DarahMasuk;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Event = new M_Event();
        $this->M_Darah = new M_Darah();
        $this->M_Donor = new M_Donor();
        $this->M_Anggota = new M_Anggota();
        $this->M_DarahMasuk = new M_DarahMasuk();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Data Pengajuan Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_event'    => $this->M_Event->get_data_user(Session()->get('id_user'))
        ];

        return view('event.pengajuan_event.v_index', $data);
    }

    public function tambah_pengajuan_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Tambah Pengajuan Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('event.pengajuan_event.v_tambah', $data);
    }

    public function proses_tambah_pengajuan_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_instansi'     => 'required',
            'alamat_lengkap'    => 'required',
            'tanggal_event'     => 'required',
            'jam'               => 'required',
            'jumlah_orang'      => 'required',
            'upload_surat'      => 'required|mimes:pdf|max:5048',
            'upload_gambar'     => 'required|mimes:jpeg,png,jpg|max:5048',
        ], [
            'nama_instansi.required'    => 'Nama Instansi harus diisi!',
            'alamat_lengkap.required'   => 'Alamat Lengkap harus diisi!',
            'tanggal_event.required'    => 'Tanggal Eevnt harus diisi!',
            'jam.required'              => 'Jam Eevnt harus diisi!',
            'jumlah_orang.required'     => 'Jumlah Orang harus diisi!',
            'upload_surat.required'     => 'Surat harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
            'upload_gambar.required'    => 'Gambar harus diisi!',
            'upload_gambar.mimes'       => 'Format Gambar harus jpeg/png/jpg!',
            'upload_gambar.max'         => 'Ukuran Gambar maksimal 5 mb',
        ]);


        $file = Request()->upload_surat;
        $file_surat = date('mdYHis') . ' ' . Request()->nama_instansi . '.' . $file->extension();
        $file->move(public_path('foto_surat'), $file_surat);

        $gambar = Request()->upload_gambar;
        $file_gambar = Request()->nama_instansi . '.' . $gambar->extension();
        $gambar->move(public_path('foto_event'), $file_gambar);

        $data = [
            'id_user'           => Session()->get('id_user'),
            'nama_instansi'     => Request()->nama_instansi,
            'alamat_lengkap'    => Request()->alamat_lengkap,
            'tanggal_event'     => Request()->tanggal_event,
            'jam'               => Request()->jam,
            'jumlah_orang'      => Request()->jumlah_orang,
            'upload_surat'      => $file_surat,
            'gambar'            => $file_gambar,
            'status_pengajuan'  => "Belum Dikirim",
            'tanggal_pengajuan' => date('Y-m-d H:i:s')
        ];

        $this->M_Event->tambah($data);
        Alert::success('Berhasil', 'Data pengajuan event berhasil ditambah.');
        return redirect()->route('pengajuan_event');
    }

    public function edit_pengajuan_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Edit Pengajuan Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'detail'        => $this->M_Event->detail($id_event)
        ];

        return view('event.pengajuan_event.v_edit', $data);
    }

    public function proses_edit_pengajuan_event($id_event)
    {
        Request()->validate([
            'nama_instansi'     => 'required',
            'alamat_lengkap'    => 'required',
            'tanggal_event'     => 'required',
            'jam'               => 'required',
            'jumlah_orang'      => 'required',
            'upload_surat'      => 'mimes:pdf|max:5048',
        ], [
            'nama_instansi.required'    => 'Nama Instansi harus diisi!',
            'alamat_lengkap.required'   => 'Alamat Lengkap harus diisi!',
            'tanggal_event.required'    => 'Tanggal Eevnt harus diisi!',
            'jam.required'              => 'Jam Eevnt harus diisi!',
            'jumlah_orang.required'     => 'Jumlah Orang harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);

        $event = $this->M_Event->detail($id_event);

        if (Request()->upload_surat <> "") {
            if ($event->upload_surat <> "") {
                unlink(public_path('foto_surat') . '/' . $event->upload_surat);
            }

            $file = Request()->upload_surat;
            $file_surat = date('mdYHis') . ' ' . Request()->nama_instansi . '.' . $file->extension();
            $file->move(public_path('foto_surat'), $file_surat);

            $data = [
                'id_event'          => $id_event,
                'nama_instansi'     => Request()->nama_instansi,
                'alamat_lengkap'    => Request()->alamat_lengkap,
                'tanggal_event'     => Request()->tanggal_event,
                'jam'               => Request()->jam,
                'jumlah_orang'      => Request()->jumlah_orang,
                'upload_surat'      => $file_surat,
            ];
        } else {
            $data = [
                'id_event'          => $id_event,
                'nama_instansi'     => Request()->nama_instansi,
                'alamat_lengkap'    => Request()->alamat_lengkap,
                'tanggal_event'     => Request()->tanggal_event,
                'jam'               => Request()->jam,
                'jumlah_orang'      => Request()->jumlah_orang
            ];
        }

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Data pengajuan event berhasil diedit.');
        return redirect()->route('pengajuan_event');
    }

    public function hapus_pengajuan_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $event = $this->M_Event->detail($id_event);

        if ($event->upload_surat <> "") {
            unlink(public_path('foto_surat') . '/' . $event->upload_surat);
        }

        if ($event->gambar <> "") {
            unlink(public_path('foto_event') . '/' . $event->gambar);
        }

        $this->M_Event->hapus($id_event);
        Alert::success('Berhasil', 'Pengajuan event berhasil dihapus.');
        return back();
    }

    public function kirim_pengajuan_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_event'          => $id_event,
            'status_pengajuan'  => "Menunggu Persetujuan",
            'tanggal_pengajuan' => date('Y-m-d')
        ];

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Pengajuan event berhasil dikirim.');
        return redirect()->route('pengajuan_event');
    }

    public function kelola_pengajuan_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Data Pengajuan Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_event'    => $this->M_Event->get_data()
        ];

        return view('admin.pengajuan_event.v_index', $data);
    }

    public function ya_pengajuan_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_event'          => $id_event,
            'status_pengajuan'  => "Disetujui",
            'status_event'      => "Aktif",
        ];

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Pengajuan event disetujui.');
        return back();
    }

    public function tidak_pengajuan_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_event'          => $id_event,
            'status_pengajuan'  => "Tidak Disetujui",
            'status_event'      => "Tidak Aktif",
        ];

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Pengajuan event tidak disetujui.');
        return back();
    }

    public function selesai_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id_event'          => $id_event,
            'status_event'      => "Tidak Aktif",
        ];

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Anda berhasil menyelesaikan event.');
        return back();
    }

    public function riwayat_pengajuan_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Riwayat Pengajuan Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_event'    => $this->M_Event->get_data()
        ];

        return view('admin.pengajuan_event.v_riwayat', $data);
    }

    public function jadwal_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Jadwal Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_event'    => $this->M_Event->get_data()
        ];

        return view('admin.pengajuan_event.v_jadwal_event', $data);
    }

    public function tambah_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Tambah Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user'))
        ];

        return view('admin.pengajuan_event.v_tambah', $data);
    }

    public function proses_tambah_event()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_instansi'     => 'required',
            'alamat_lengkap'    => 'required',
            'tanggal_event'     => 'required',
            'jam'               => 'required',
            'jumlah_orang'      => 'required',
            'upload_surat'      => 'required|mimes:pdf|max:5048',
        ], [
            'nama_instansi.required'    => 'Nama Instansi harus diisi!',
            'alamat_lengkap.required'   => 'Alamat Lengkap harus diisi!',
            'tanggal_event.required'    => 'Tanggal Eevnt harus diisi!',
            'jam.required'              => 'Jam Eevnt harus diisi!',
            'jumlah_orang.required'     => 'Jumlah Orang harus diisi!',
            'upload_surat.required'     => 'Surat harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);


        $file = Request()->upload_surat;
        $file_surat = date('mdYHis') . ' ' . Request()->nama_instansi . '.' . $file->extension();
        $file->move(public_path('foto_surat'), $file_surat);

        $data = [
            'id_user'           => Session()->get('id_user'),
            'nama_instansi'     => Request()->nama_instansi,
            'alamat_lengkap'    => Request()->alamat_lengkap,
            'tanggal_event'     => Request()->tanggal_event,
            'jam'               => Request()->jam,
            'jumlah_orang'      => Request()->jumlah_orang,
            'upload_surat'      => $file_surat,
            'status_pengajuan'  => "Dibuat Admin",
            'status_event'      => "Aktif",
            'tanggal_pengajuan' => date('Y-m-d H:i:s')
        ];

        $this->M_Event->tambah($data);
        Alert::success('Berhasil', 'Data pengajuan event berhasil ditambah.');
        return redirect()->route('jadwal_event');
    }

    public function edit_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Edit Event',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'detail'        => $this->M_Event->detail($id_event)
        ];

        return view('admin.pengajuan_event.v_edit', $data);
    }

    public function proses_edit_event($id_event)
    {
        Request()->validate([
            'nama_instansi'     => 'required',
            'alamat_lengkap'    => 'required',
            'tanggal_event'     => 'required',
            'jam'               => 'required',
            'jumlah_orang'      => 'required',
            'upload_surat'      => 'mimes:pdf|max:5048',
        ], [
            'nama_instansi.required'    => 'Nama Instansi harus diisi!',
            'alamat_lengkap.required'   => 'Alamat Lengkap harus diisi!',
            'tanggal_event.required'    => 'Tanggal Eevnt harus diisi!',
            'jam.required'              => 'Jam Eevnt harus diisi!',
            'jumlah_orang.required'     => 'Jumlah Orang harus diisi!',
            'upload_surat.mimes'        => 'Format Surat harus PDF!',
            'upload_surat.max'          => 'Ukuran Surat maksimal 5 mb',
        ]);

        $event = $this->M_Event->detail($id_event);

        if (Request()->upload_surat <> "") {
            if ($event->upload_surat <> "") {
                unlink(public_path('foto_surat') . '/' . $event->upload_surat);
            }

            $file = Request()->upload_surat;
            $file_surat = date('mdYHis') . ' ' . Request()->nama_instansi . '.' . $file->extension();
            $file->move(public_path('foto_surat'), $file_surat);

            $data = [
                'id_event'          => $id_event,
                'nama_instansi'     => Request()->nama_instansi,
                'alamat_lengkap'    => Request()->alamat_lengkap,
                'tanggal_event'     => Request()->tanggal_event,
                'jam'               => Request()->jam,
                'jumlah_orang'      => Request()->jumlah_orang,
                'upload_surat'      => $file_surat,
            ];
        } else {
            $data = [
                'id_event'          => $id_event,
                'nama_instansi'     => Request()->nama_instansi,
                'alamat_lengkap'    => Request()->alamat_lengkap,
                'tanggal_event'     => Request()->tanggal_event,
                'jam'               => Request()->jam,
                'jumlah_orang'      => Request()->jumlah_orang
            ];
        }

        $this->M_Event->edit($data);
        Alert::success('Berhasil', 'Data pengajuan event berhasil diedit.');
        return redirect()->route('jadwal_event');
    }

    public function tambah_darah_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $dataTerakhir = $this->M_Darah->data_terakhir();

        if ($dataTerakhir === null) {
            $no_kantong = 'K1';
        } else {
            $kata = $dataTerakhir->no_kantong;
            // $kata = 'K1';
            $angka = substr($kata, 1) + 1;
            $no_kantong = 'K' . $angka;
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Jadwal Event',
            'data_web'      => $this->M_Website->detail(1),
            'no_kantong'    => $no_kantong,
            'detail'        => $this->M_Event->detail($id_event),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.pengajuan_event.v_tambah_darah', $data);
    }

    public function proses_tambah_darah_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'nama_anggota'          => 'required',
            'alamat'                => 'required',
            'jenis_kelamin'         => 'required',
            'golongan_darah'        => 'required',
            'resus'                 => 'required',
            'volume_darah'          => 'required',
        ], [
            'nama_anggota.required'         => 'Nama anggota harus diisi!',
            'alamat.required'               => 'Alamat harus diisi!',
            'jenis_kelamin.required'        => 'Jenis kelamin harus diisi!',
            'golongan_darah.required'       => 'Golongan darah harus diisi!',
            'resus.required'                => 'Resus harus diisi!',
            'volume_darah.required'         => 'Volume darah harus diisi!',
        ]);

        $data_anggota = [
            'nama_anggota'      => Request()->nama_anggota,
            'nik'               => Request()->nik,
            'no_wa'             => Request()->no_wa,
            'alamat'            => Request()->alamat,
            'jenis_kelamin'     => Request()->jenis_kelamin,
            'status_anggota'    => 'Event',
            'tanggal_donor_kembali' => date('Y-m-d', strtotime('+30 days', strtotime(date('Y-m-d')))),
        ];
        $this->M_Anggota->tambah($data_anggota);

        $data_terakhir_anggota = $this->M_Anggota->data_terakhir();

        $data_donor = [
            'id_anggota'                => $data_terakhir_anggota->id_anggota,
            'id_event'                  => $id_event,
            'tanggal_donor'             => date('Y-m-d H:i:s'),
            'status_donor'              => 'Selesai',
            'hasil_kusioner'            => 'Lolos',
            'deskripsi_hasil_kusioner'  => 'Donor darah dari event',
        ];
        $this->M_Donor->tambah($data_donor);

        $data_terakhir_donor = $this->M_Donor->data_terakhir();

        $data_darah = [
            'id_donor'              => $data_terakhir_donor->id_donor,
            'no_kantong'            => Request()->no_kantong,
            'golongan_darah'        => Request()->golongan_darah,
            'resus'                 => Request()->resus,
            'volume_darah'          => Request()->volume_darah,
            'tanggal_kedaluwarsa'   => date('Y-m-d', strtotime('+35 days', strtotime(date('Y-m-d')))),
            'tanggal_darah_masuk'   => date('Y-m-d H:i:s')
        ];
        $this->M_Darah->tambah($data_darah);

        $data_terakhir_darah = $this->M_Darah->data_terakhir();

        $data_darah_masuk = [
            'id_darah'      => $data_terakhir_darah->id_darah,
            'id_user'       => Session()->get('id_user'),
        ];
        $this->M_DarahMasuk->tambah($data_darah_masuk);

        Alert::success('Berhasil', 'Data darah berhasil ditambah.');
        return redirect()->back();
    }

    public function detail_event($id_event)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Pengajuan Event',
            'sub_title'     => 'Detail Event',
            'data_web'      => $this->M_Website->detail(1),
            'detail'        => $this->M_Event->detail($id_event),
            'data_darah'    => $this->M_Darah->get_data(),
            'jumlah_donor'  => $this->M_Donor->jumlah_donor_event($id_event),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
        ];

        return view('admin.pengajuan_event.v_detail', $data);
    }
}

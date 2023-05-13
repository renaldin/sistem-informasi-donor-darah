<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Event;
use Illuminate\Contracts\Session\Session;
use RealRashid\SweetAlert\Facades\Alert;

class C_PengajuanEvent extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Event;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Event = new M_Event();
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
            'status_pengajuan'  => "Belum Dikirim",
            'tanggal_pengajuan' => date('Y-m-d')
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
            'tanggal_pengajuan' => date('Y-m-d')
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
}

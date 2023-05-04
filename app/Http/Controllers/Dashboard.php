<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\ModelBiodataWeb;

class Dashboard extends Controller
{

    private $ModelUser;
    private $ModelBiodataWeb;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelBiodataWeb = new ModelBiodataWeb();
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
                'biodata'               => $this->ModelBiodataWeb->detail(1),
                'user'                  => $this->ModelUser->detail(Session()->get('id_user')),
                'jumlahUser'            => $this->ModelUser->jumlahUser(),
            ];
            return view('admin.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Pegawai') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->ModelUser->detail(Session()->get('id_user')),
                'biodata'               => $this->ModelBiodataWeb->detail(1),
            ];
            return view('pegawai.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Wakil Direktur') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->ModelUser->detail(Session()->get('id_user')),
                'biodata'               => $this->ModelBiodataWeb->detail(1),
            ];
            return view('wakildirektur.v_dashboard', $data);
        } elseif (Session()->get('role') === 'Ketua Jurusan') {
            $data = [
                'title'                 => 'Dashboard',
                'subTitle'              => 'Dashboard',
                'user'                  => $this->ModelUser->detail(Session()->get('id_user')),
                'biodata'               => $this->ModelBiodataWeb->detail(1),
            ];
            return view('ketuajurusan.v_dashboard', $data);
        }
    }
}

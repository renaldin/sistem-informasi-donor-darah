<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_PermohonanDarah extends Model
{
    use HasFactory;
    public $table = 'permohonan_darah';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'permohonan_darah.id_user', 'left')
            ->orderBy('id_permohonan_darah', 'DESC')->get();
    }

    public function get_data_user($id_user)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'permohonan_darah.id_user', 'left')
            ->where('permohonan_darah.id_user', $id_user)
            ->orderBy('id_permohonan_darah', 'DESC')
            ->get();
    }

    public function detail($id_permohonan_darah)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'permohonan_darah.id_user', 'left')
            ->where('id_permohonan_darah', $id_permohonan_darah)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_permohonan_darah', $data['id_permohonan_darah'])->update($data);
    }

    public function hapus($id_permohonan_darah)
    {
        DB::table($this->table)->where('id_permohonan_darah', $id_permohonan_darah)->delete();
    }

    public function getPermohonanPerbulan()
    {
        $data = [
            'januari'   => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 1)->where('status_permohonan', 'Diterima')->count(),
            'februari'  => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 2)->where('status_permohonan', 'Diterima')->count(),
            'maret'     => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 3)->where('status_permohonan', 'Diterima')->count(),
            'april'     => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 4)->where('status_permohonan', 'Diterima')->count(),
            'mei'       => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 5)->where('status_permohonan', 'Diterima')->count(),
            'juni'      => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 6)->where('status_permohonan', 'Diterima')->count(),
            'juli'      => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 7)->where('status_permohonan', 'Diterima')->count(),
            'agustus'   => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 8)->where('status_permohonan', 'Diterima')->count(),
            'september' => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 9)->where('status_permohonan', 'Diterima')->count(),
            'oktober'   => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 10)->where('status_permohonan', 'Diterima')->count(),
            'november'  => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 11)->where('status_permohonan', 'Diterima')->count(),
            'desember'  => DB::table($this->table)->whereYear('tanggal_permohonan', date('Y'))->whereMonth('tanggal_permohonan', 12)->where('status_permohonan', 'Diterima')->count(),
        ];
        return $data;
    }

    public function countPermohonan($status)
    {
        return DB::table($this->table)->where('status_permohonan', $status)->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Event extends Model
{
    use HasFactory;
    public $table = 'event';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->orderBy('tanggal_event', 'DESC')->get();
    }

    public function get_all_data($bulan)
    {
        if ($bulan == null) {
            return DB::table($this->table)
                ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
                ->where('tanggal_event', '>=', date('Y-m-d'))
                ->orderBy('tanggal_event', 'DESC')->get();
        }
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->where('tanggal_event', '>=', date('Y-m-d'))
            ->whereMonth('tanggal_event', $bulan)
            ->orderBy('tanggal_event', 'DESC')->get();
    }

    public function get_data_user($id_user)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->where('event.id_user', $id_user)->orderBy('tanggal_event', 'DESC')->get();
    }

    public function detail($id_event)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->where('id_event', $id_event)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_event', $data['id_event'])->update($data);
    }

    public function hapus($id_event)
    {
        DB::table($this->table)->where('id_event', $id_event)->delete();
    }

    public function getEventPerbulan()
    {
        $data = [
            'januari'   => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 1)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'februari'  => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 2)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'maret'     => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 3)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'april'     => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 4)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'mei'       => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 5)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'juni'      => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 6)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'juli'      => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 7)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'agustus'   => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 8)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'september' => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 9)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'oktober'   => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 10)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'november'  => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 11)
                ->where('status_pengajuan', 'Disetujui')->count(),
            'desember'  => DB::table($this->table)
                ->whereYear('tanggal_pengajuan', date('Y'))->whereMonth('tanggal_pengajuan', 12)
                ->where('status_pengajuan', 'Disetujui')->count(),
        ];
        return $data;
    }

    public function countEvent($status)
    {
        return DB::table($this->table)->where('status_event', $status)->count();
    }

    public function countEventUser($status)
    {
        return DB::table($this->table)->where('id_user', Session()->get('id_user'))->where('status_event', $status)->count();
    }

    public function data_terakhir()
    {
        return DB::table($this->table)->limit(1)->orderBy('id_event', 'DESC')->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Parser\Block\ThematicBreakStartParser;

class M_Donor extends Model
{
    use HasFactory;
    public $table = 'donor';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('anggota', 'anggota.id_anggota', '=', 'donor.id_anggota', 'left')
            ->orderBy('tanggal_donor', 'DESC')->get();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_donor', $data['id_donor'])->update($data);
    }

    public function data_terakhir()
    {
        return DB::table($this->table)->limit(1)->orderBy('id_donor', 'DESC')->first();
    }

    public function jumlah_donor_event($id_event)
    {
        return DB::table($this->table)->where('id_event', $id_event)->count();
    }

    public function get_all_by_anggota($id_anggota)
    {
        return DB::table($this->table)
            ->join('anggota', 'anggota.id_anggota', '=', 'donor.id_anggota', 'left')
            ->where('donor.id_anggota', $id_anggota)->get();
    }
}

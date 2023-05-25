<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Darah extends Model
{
    use HasFactory;
    public $table = 'darah';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('donor', 'donor.id_donor', '=', 'darah.id_donor', 'left')
            ->join('anggota', 'anggota.id_anggota', '=', 'donor.id_anggota', 'left')
            ->orderBy('id_darah', 'DESC')->get();
    }

    // public function detail($id_darah)
    // {
    //     return DB::table($this->table)
    //         ->where('id_darah', $id_darah)->first();
    // }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_darah', $data['id_darah'])->update($data);
    }

    // public function hapus($id_darah)
    // {
    //     DB::table($this->table)->where('id_darah', $id_darah)->delete();
    // }

    public function data_terakhir()
    {
        return DB::table($this->table)->limit(1)->orderBy('id_darah', 'DESC')->first();
    }
}

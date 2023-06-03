<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Anggota extends Model
{
    use HasFactory;
    public $table = 'anggota';

    public function get_data()
    {
        return DB::table($this->table)->orderBy('id_anggota', 'DESC')->get();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_anggota', $data['id_anggota'])->update($data);
    }

    public function data_terakhir()
    {
        return DB::table($this->table)->limit(1)->orderBy('id_anggota', 'DESC')->first();
    }

    public function cek_nik($nik)
    {
        return DB::table($this->table)->where('nik', $nik)->first();
    }
}

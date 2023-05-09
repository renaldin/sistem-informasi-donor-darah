<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_DarahKeluar extends Model
{
    use HasFactory;
    public $table = 'darah_keluar';

    public function get_data()
    {
        return DB::table($this->table)
            ->orderBy('id_darah_keluar', 'DESC')->get();
    }

    public function detail($id_darah_keluar)
    {
        return DB::table($this->table)
            ->where('id_darah_keluar', $id_darah_keluar)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_darah_keluar', $data['id_darah_keluar'])->update($data);
    }

    public function hapus($id_darah_keluar)
    {
        DB::table($this->table)->where('id_darah_keluar', $id_darah_keluar)->delete();
    }
}

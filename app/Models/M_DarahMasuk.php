<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_DarahMasuk extends Model
{
    use HasFactory;
    public $table = 'darah_masuk';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_masuk.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')
            ->orderBy('darah.tanggal_darah_masuk', 'ASC')->get();
    }

    public function detail($id_darah_masuk)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_masuk.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')
            ->where('id_darah_masuk', $id_darah_masuk)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_darah_masuk', $data['id_darah_masuk'])->update($data);
    }

    public function hapus($id_darah_masuk)
    {
        DB::table($this->table)->where('id_darah_masuk', $id_darah_masuk)->delete();
    }
}

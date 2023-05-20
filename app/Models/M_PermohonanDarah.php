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
}

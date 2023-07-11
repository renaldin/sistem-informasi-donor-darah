<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_DarahBuang extends Model
{
    use HasFactory;
    public $table = 'darah_buang';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_buang.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')
            ->join('donor', 'donor.id_donor', '=', 'darah.id_donor', 'left')
            ->orderBy('id_darah_buang', 'DESC')->get();
    }

    public function get_data_tanggal($tanggal_mulai, $tanggal_akhir)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_buang.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')
            ->join('donor', 'donor.id_donor', '=', 'darah.id_donor', 'left')
            ->whereBetween('tanggal_buang', [$tanggal_mulai, $tanggal_akhir])
            ->orderBy('id_darah_buang', 'DESC')->get();
    }

    // public function detail($id_darah_buang)
    // {
    //     return DB::table($this->table)
    //         ->where('id_darah_buang', $id_darah_buang)->first();
    // }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // public function edit($data)
    // {
    //     DB::table($this->table)->where('id_darah_buang', $data['id_darah_buang'])->update($data);
    // }

    // public function hapus($id_darah_buang)
    // {
    //     DB::table($this->table)->where('id_darah_buang', $id_darah_buang)->delete();
    // }

    public function countGol()
    {
        $data = [
            'a+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'A')->where('resus', 'Positif')->count(),
            'b+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'B')->where('resus', 'Positif')->count(),
            'ab+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'AB')->where('resus', 'Positif')->count(),
            'o+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'O')->where('resus', 'Positif')->count(),
            'a-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'A')->where('resus', 'Negatif')->count(),
            'b-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'B')->where('resus', 'Negatif')->count(),
            'ab-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'AB')->where('resus', 'Negatif')->count(),
            'o-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_buang.id_darah', 'left')->where('golongan_darah', 'O')->where('resus', 'Negatif')->count(),
        ];
        return $data;
    }

    public function jumlah()
    {
        return DB::table($this->table)->count();
    }
}

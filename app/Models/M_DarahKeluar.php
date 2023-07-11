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
            ->join('permohonan_darah', 'permohonan_darah.id_permohonan_darah', '=', 'darah_keluar.id_permohonan_darah', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')
            ->orderBy('id_darah_keluar', 'ASC')->get();
    }

    public function get_data_tanggal($tanggal_mulai, $tanggal_akhir)
    {
        return DB::table($this->table)
            ->join('permohonan_darah', 'permohonan_darah.id_permohonan_darah', '=', 'darah_keluar.id_permohonan_darah', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')
            ->whereBetween('tanggal_keluar', [$tanggal_mulai, $tanggal_akhir])
            ->orderBy('id_darah_keluar', 'ASC')->get();
    }

    public function get_data_permohonan($id_permohonan_darah)
    {
        return DB::table($this->table)
            ->join('permohonan_darah', 'permohonan_darah.id_permohonan_darah', '=', 'darah_keluar.id_permohonan_darah', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')
            ->where('darah_keluar.id_permohonan_darah', $id_permohonan_darah)
            ->orderBy('id_darah_keluar', 'DESC')->get();
    }

    public function get_darah_keluar($id_darah_keluar)
    {
        return DB::table($this->table)
            ->join('permohonan_darah', 'permohonan_darah.id_permohonan_darah', '=', 'darah_keluar.id_permohonan_darah', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')
            ->where('darah_keluar.id_darah_keluar', $id_darah_keluar)
            ->orderBy('id_darah_keluar', 'DESC')->first();
    }

    public function detail($id_darah_keluar)
    {
        return DB::table($this->table)
            ->join('permohonan_darah', 'permohonan_darah.id_permohonan_darah', '=', 'darah_keluar.id_permohonan_darah', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')
            ->where('darah_keluar.id_darah_keluar', $id_darah_keluar)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // public function edit($data)
    // {
    //     DB::table($this->table)->where('id_darah_keluar', $data['id_darah_keluar'])->update($data);
    // }

    public function hapus($id_darah_keluar)
    {
        DB::table($this->table)->where('id_darah_keluar', $id_darah_keluar)->delete();
    }

    public function countGol()
    {
        $data = [
            'a+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'A')->where('resus', 'Positif')->count(),
            'b+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'B')->where('resus', 'Positif')->count(),
            'ab+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'AB')->where('resus', 'Positif')->count(),
            'o+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'O')->where('resus', 'Positif')->count(),
            'a-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'A')->where('resus', 'Negatif')->count(),
            'b-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'B')->where('resus', 'Negatif')->count(),
            'ab-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'AB')->where('resus', 'Negatif')->count(),
            'o-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_keluar.id_darah', 'left')->where('golongan_darah', 'O')->where('resus', 'Negatif')->count(),
        ];
        return $data;
    }

    public function jumlah()
    {
        return DB::table($this->table)->count();
    }
}

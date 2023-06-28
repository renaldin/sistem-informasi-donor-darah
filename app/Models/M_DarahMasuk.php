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

    public function get_data_tanggal($tanggal_mulai, $tanggal_akhir)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_masuk.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')
            ->whereBetween('tanggal_masuk', [$tanggal_mulai, $tanggal_akhir])
            ->orderBy('darah.tanggal_darah_masuk', 'ASC')->get();
    }

    public function detail($id_darah_masuk)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'darah_masuk.id_user', 'left')
            ->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')
            ->join('donor', 'donor.id_donor', '=', 'darah.id_donor', 'left')
            ->join('anggota', 'anggota.id_anggota', '=', 'donor.id_anggota', 'left')
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

    public function getDataPerBulan()
    {
        $data = [
            'januari'   => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 1)->count(),
            'februari'  => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 2)->count(),
            'maret'     => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 3)->count(),
            'april'     => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 4)->count(),
            'mei'       => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 5)->count(),
            'juni'      => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 6)->count(),
            'juli'      => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 7)->count(),
            'agustus'   => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 8)->count(),
            'september' => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 9)->count(),
            'oktober'   => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 10)->count(),
            'november'  => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 11)->count(),
            'desember'  => DB::table($this->table)->whereYear('tanggal_masuk', date('Y'))->whereMonth('tanggal_masuk', 12)->count(),
        ];
        return $data;
    }

    public function countGol($status)
    {
        $data = [
            'a+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'A')->where('status_darah_masuk', $status)->where('resus', 'Positif')->count(),
            'b+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'B')->where('status_darah_masuk', $status)->where('resus', 'Positif')->count(),
            'ab+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'AB')->where('status_darah_masuk', $status)->where('resus', 'Positif')->count(),
            'o+' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'O')->where('status_darah_masuk', $status)->where('resus', 'Positif')->count(),
            'a-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'A')->where('status_darah_masuk', $status)->where('resus', 'Negatif')->count(),
            'b-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'B')->where('status_darah_masuk', $status)->where('resus', 'Negatif')->count(),
            'ab-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'AB')->where('status_darah_masuk', $status)->where('resus', 'Negatif')->count(),
            'o-' => DB::table($this->table)->join('darah', 'darah.id_darah', '=', 'darah_masuk.id_darah', 'left')->where('tanggal_kedaluwarsa', '>=', date('Y-m-d'))->where('golongan_darah', 'O')->where('status_darah_masuk', $status)->where('resus', 'Negatif')->count(),
        ];
        return $data;
    }
}

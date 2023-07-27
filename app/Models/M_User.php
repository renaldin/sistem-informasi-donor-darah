<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_User extends Model
{
    use HasFactory;
    public $table = 'user';

    public function get_data()
    {
        return DB::table($this->table)
            ->orderBy('id_user', 'DESC')->get();
    }

    public function detail($id_user)
    {
        return DB::table($this->table)->where('id_user', $id_user)->first();
    }

    public function detail_email($email)
    {
        return DB::table($this->table)->where('email', $email)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_user', $data['id_user'])->update($data);
    }

    public function hapus($id_user)
    {
        DB::table($this->table)->where('id_user', $id_user)->delete();
    }

    public function jumlah_user()
    {
        return DB::table($this->table)->count();
    }

    public function countUser($role)
    {
        return DB::table($this->table)->where('role', $role)->count();
    }

    public function last_data()
    {
        return DB::table($this->table)->orderBy('id_user', 'DESC')->limit(1)->first();
    }

    public function getPetugasByDonor($id_kuesioner)
    {
        $donor = DB::table('kuesioner_donor')->where('id_kuesioner', $id_kuesioner)->first();
        $paskes = DB::table('donor')->where('id_donor', $donor->id_donor)->first();
        return DB::table($this->table)->where('id_user', $paskes->id_petugas_kesehatan)->first();
    }

    public function getPetugasKuesionerByDonor($id_kuesioner)
    {
        $donor = DB::table('kuesioner_donor')->where('id_kuesioner', $id_kuesioner)->first();
        $paskes = DB::table('donor')->where('id_donor', $donor->id_donor)->first();
        return DB::table($this->table)->where('id_user', $paskes->id_petugas_kuesioner)->first();
    }

    // Beda Tabel
    public function tambah_donatur($data)
    {
        DB::table('user_donatur')->insert($data);
    }

    public function edit_donatur($data)
    {
        DB::table('user_donatur')->where('id_user_donatur', $data['id_user_donatur'])->update($data);
    }

    public function edit_user_donatur($data)
    {
        DB::table('user_donatur')->where('id_user', $data['id_user'])->update($data);
    }

    public function detail_user_donatur($id_user)
    {
        return DB::table('user_donatur')
            ->join('user', 'user.id_user', '=', 'user_donatur.id_user')
            ->where('user_donatur.id_user', $id_user)->first();
    }

    public function detail_user_donatur_nik($nik)
    {
        return DB::table('user_donatur')
            ->join('user', 'user.id_user', '=', 'user_donatur.id_user')
            ->where('user_donatur.nik', $nik)->first();
    }

    public function hapus_user_donatur($id_user)
    {
        DB::table('user_donatur')->where('id_user', $id_user)->delete();
    }

    public function tambah_event($data)
    {
        DB::table('user_event')->insert($data);
    }

    public function edit_event($data)
    {
        DB::table('user_event')->where('id_user_event', $data['id_user_event'])->update($data);
    }

    public function edit_user_event($data)
    {
        DB::table('user_event')->where('id_user', $data['id_user'])->update($data);
    }

    public function detail_user_event($id_user)
    {
        return DB::table('user_event')
            ->join('user', 'user.id_user', '=', 'user_event.id_user')
            ->where('user_event.id_user', $id_user)->first();
    }

    public function hapus_user_event($id_user)
    {
        DB::table('user_event')->where('id_user', $id_user)->delete();
    }

    public function tambah_rumah_sakit($data)
    {
        DB::table('user_rs')->insert($data);
    }

    public function edit_rs($data)
    {
        DB::table('user_rs')->where('id_user_rs', $data['id_user_rs'])->update($data);
    }

    public function edit_user_rumah_sakit($data)
    {
        DB::table('user_rs')->where('id_user', $data['id_user'])->update($data);
    }

    public function detail_user_rs($id_user)
    {
        return DB::table('user_rs')
            ->join('user', 'user.id_user', '=', 'user_rs.id_user')
            ->where('user_rs.id_user', $id_user)->first();
    }

    public function hapus_user_rs($id_user)
    {
        DB::table('user_rs')->where('id_user', $id_user)->delete();
    }
}

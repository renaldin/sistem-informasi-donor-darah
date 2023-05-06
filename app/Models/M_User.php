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
        return DB::table($this->table)->orderBy('id_user', 'DESC')->get();
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
}

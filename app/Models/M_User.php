<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_User extends Model
{
    use HasFactory;
    public $table = 'users';

    public function getData()
    {
        return DB::table($this->table)->orderBy('id_user', 'DESC')->get();
    }

    public function detail($id_user)
    {
        return DB::table($this->table)->where('id_user', $id_user)->first();
    }

    public function detailByEmail($email)
    {
        return DB::table($this->table)->where('email', $email)->first();
    }

    public function add($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_user', $data['id_user'])->update($data);
    }

    public function deleteData($id_user)
    {
        DB::table($this->table)->where('id_user', $id_user)->delete();
    }

    public function jumlahUser()
    {
        return DB::table($this->table)->count();
    }
}

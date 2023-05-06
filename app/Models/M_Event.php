<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Event extends Model
{
    use HasFactory;
    public $table = 'event';

    public function get_data()
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->orderBy('id_event', 'DESC')->get();
    }

    public function get_data_user($id_user)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->where('event.id_user', $id_user)->orderBy('id_event', 'DESC')->get();
    }

    public function detail($id_event)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'event.id_user', 'left')
            ->where('id_event', $id_event)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        DB::table($this->table)->where('id_event', $data['id_event'])->update($data);
    }

    public function hapus($id_event)
    {
        DB::table($this->table)->where('id_event', $id_event)->delete();
    }
}

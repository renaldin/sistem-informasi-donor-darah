<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Auth extends Model
{
    use HasFactory;

    public function register($data)
    {
        DB::table('user')->insert($data);
    }

    public function cekEmailUser($email)
    {
        return DB::table('users')->where('email', $email)->first();
    }

    public function cekEmailAdmin($email)
    {
        return DB::table('admin')->where('email', $email)->first();
    }
}

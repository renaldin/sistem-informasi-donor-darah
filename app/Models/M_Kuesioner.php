<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Parser\Block\ThematicBreakStartParser;

class M_Kuesioner extends Model
{
    use HasFactory;
    public $table = 'kuesioner_donor';

    public function detail($id_kuesioner)
    {
        return DB::table($this->table)
            ->join('donor', 'donor.id_donor', '=', 'kuesioner_donor.id_donor', 'left')
            ->where('id_kuesioner', $id_kuesioner)->first();
    }

    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }
}

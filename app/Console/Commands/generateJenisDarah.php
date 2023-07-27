<?php

namespace App\Console\Commands;


use App\Models\M_Darah;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class generateJenisDarah extends Command
{
    public $M_Darah;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jenisDarah:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->M_Darah = new M_Darah();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $darah = $this->M_Darah->get_data();

        foreach ($darah as $item) {
            $tgl_lahir = new DateTime($item->tanggal_darah_masuk);
            $sekarang = new DateTime();
            $diff = $tgl_lahir->diff($sekarang);
            $umur_hari = $diff->days;

            if ($umur_hari >= 0 && $umur_hari < 2) {
                $jenisDarah = 'Darah Segar';
            } elseif ($umur_hari >= 2 && $umur_hari < 7) {
                $jenisDarah = 'Darah Baru';
            } elseif ($umur_hari >= 7) {
                $jenisDarah = 'Darah Simpan';
            }

            $data = [
                'id_darah'  => $item->id_darah,
                'jenis_darah' => $jenisDarah
            ];
            $this->M_Darah->edit($data);
        }
    }
}

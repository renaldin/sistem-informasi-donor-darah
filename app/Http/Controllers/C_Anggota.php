<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use App\Models\M_Website;
use App\Models\M_Anggota;
use App\Models\M_Darah;
use RealRashid\SweetAlert\Facades\Alert;
use Twilio\Rest\Client;

class C_Anggota extends Controller
{

    private $M_User;
    private $M_Website;
    private $M_Anggota;
    private $M_Darah;

    public function __construct()
    {
        $this->M_User = new M_User();
        $this->M_Website = new M_Website();
        $this->M_Anggota = new M_Anggota();
        $this->M_Darah = new M_Darah();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title'         => 'Anggota',
            'sub_title'     => 'Data Anggota',
            'data_web'      => $this->M_Website->detail(1),
            'user'          => $this->M_User->detail(Session()->get('id_user')),
            'data_anggota'  => $this->M_Anggota->get_data(),
            'data_darah'    => $this->M_Darah->get_data()
        ];

        return view('admin.anggota.v_index', $data);
    }

    public function kirim_jadwal($id_anggota)
    {
        $detail = $this->M_Anggota->detail($id_anggota);

        $sid = "AC3152032a13274daaa83569dad0c55b43";
        $token = "ffd93e355ec798e02be02dfc06a9fb28";
        // $sid    = "AC944f941fef8a459f011bb10c3236df78";
        // $token  = "df97bc683bb53f68b7bb6e2dd0274dc4";
        $client = new Client($sid, $token);

        $noWa = substr($detail->no_wa, 1);
        $twilioNumber = "+14155238886";
        $recipientNumber = "+62" . $noWa;

        $message = $client->messages->create(
            'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
            [
                'from' => 'whatsapp:' . $twilioNumber,
                'body' => "Hallo {$detail->nama_anggota}!!!.\n\nAnda telah memasuki jadwal donor. Anda dapat melakukan donor darah online atau offline. Ayo segera donor!!!\n\nTerima kasih.", // Replace with your desired message
            ]
        );

        Alert::success('Berhasil', "Anda berhasil mengirimkan pesan Whatsapp ke anggota yang bernama {$detail->nama_anggota}.");
        return redirect()->route('anggota');
    }
}

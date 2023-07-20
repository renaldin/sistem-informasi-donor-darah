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

        $noWa = substr($detail->no_wa, 1);

        $token = 'e5fb363842fe73cfa129904b04f393bb86ee59fe2e90a44f2eec8d630799a455';
        $whatsapp_phone = '+62' . $noWa;

        $message = "Hallo {$detail->nama_anggota}!!!.\n\nAnda telah memasuki jadwal donor. Anda dapat melakukan donor darah online atau offline. Ayo segera donor!!!\n\nTerima kasih.";

        $url = "https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp";

        $data = [
            "phone" => $whatsapp_phone,
            "messageType" => "text",
            "body" => $message
        ];


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "API-Key: $token",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        curl_exec($curl);
        curl_close($curl);

        Alert::success('Berhasil', "Anda berhasil mengirimkan pesan Whatsapp ke anggota yang bernama {$detail->nama_anggota}.");
        return redirect()->route('anggota');
    }
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Antrian</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
    <style>
        body {
            margin: 0;
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #757575;
            text-align: left;
            background-color: #fff;
        }

        .container {
            width: 100%;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 7px);
            padding: 0.1rem 0.5rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: 0.25rem;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }
    </style>
</head>

<body>
    @php
        function tanggal_indonesia($tanggal)
        {
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
            $tanggal_array = explode('-', $tanggal);
            $tahun = $tanggal_array[0];
            $bulan_angka = intval($tanggal_array[1]);
            $tanggal_angka = intval($tanggal_array[2]);
        
            $tanggal_indonesia = $tanggal_angka . ' ' . $bulan[$bulan_angka - 1] . ' ' . $tahun;
        
            return $tanggal_indonesia;
        }
    @endphp
    <section>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    {{-- <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" /> --}}
                                </td>

                                <td>
                                    {{ $data_web->nama_website }}<br />
                                    {{ $data_web->alamat }}<br />
                                    {{ $data_web->email }}<br />
                                    {{ $data_web->nomor_telepon }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h3 align="center" class="m-0 font-weight-bold">Cetak Formulir Donor</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row border-bottom mb-3">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nik">Kartu</label>
                                    <input type="text" class="form-control @error('kartu') is-invalid @enderror"
                                        id="kartu" name="kartu" placeholder="Masukan Kartu Anda"
                                        value="{{ $data_donor->kartu }}" readonly>
                                    {{-- <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" placeholder="Masukan NIK Anda"
                                        value="{{ $data ? $data_donor->nik : '' }}" {{ $data ? 'readonly' : '' }}> --}}
                                    @error('kartu')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK / No. SIM</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" placeholder="Masukan NIK Anda"
                                        value="{{ $data_donor->nik }}" readonly>
                                    {{-- <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" placeholder="Masukan NIK Anda"
                                        value="{{ $data ? $data_donor->nik : '' }}" {{ $data ? 'readonly' : '' }}> --}}
                                    @error('nik')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" placeholder="Masukan Nama"
                                        value="{{ $data_donor->nama }}" readonly>
                                    @error('nama')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        id="alamat" name="alamat" placeholder="Masukan Alamat"
                                        value="{{ $data_donor->alamat_user }}" readonly>
                                    @error('alamat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" placeholder="Masukan Jenis Kelamin"
                                        value="{{ $data_donor->jk }}" readonly>
                                    @error('jenis_kelamin')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="no_wa">Nomor Whatsapp</label>
                                    <input type="text" onkeydown="return hanyaAngka(event)"
                                        class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                                        name="no_wa" placeholder="Masukan Nomor Whatsapp"
                                        value="{{ $data_donor->nomor_telepon }}" required readonly>
                                    @error('no_wa')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <p>Tanggal Donor : {{ tanggal_indonesia($data_donor->tanggal_donor) }}
                            {{ date('H:i:s', strtotime($data_donor->tanggal_donor)) }}</p>
                        <p><b>Status Kuesioner :
                                {{ $data_donor->hasil_kusioner == 'Proses' ? 'Belum Divalidasi' : $data_donor->hasil_kusioner }}</b>
                        </p>
                        <p><b>Status Donor :
                                {{ $data_donor->hasil_kusioner == 'Tidak Lolos' ? 'Gagal' : $data_donor->status_donor }}</b>
                        </p>
                        <hr>
                        <h4>Data Kuesioner</h4>
                        @if ($data_donor->id_petugas_kuesioner)
                            <p class="ml-4">Nama Petugas Kuesioner : {{ $data_kuesioner->nama }}</p>
                        @endif

                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>1. Merasa sehat pada hari ini?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya1" name="p[1]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_1 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak1" name="p[1]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_1 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak1">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>2. Sedang minum anti biotic?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya2" name="p[2]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_2 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya2">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak2" name="p[2]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_2 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>3. Sedang minum obat lain untuk infeksi?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya3" name="p[3]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_3 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya3">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak3" name="p[3]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_3 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak3">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 48 jam terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>4. Apakah anda sedang minum aspirin atau obat yang mengandung aspirin?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya4" name="p[4]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_4 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya4">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak4" name="p[4]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_4 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak4">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>5. Apakah anda megalami sakit kepala dan demam bersamaan?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya5" name="p[5]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_5 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya5">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak5" name="p[5]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_5 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak5">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>6. Untuk donor darah wanita? Apakah anda saat ini sedang hamil? Jika Ya, kehamilan
                                    dibulan ke berapa?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" onclick="showKehamilan()" id="Ya6" name="p[6]"
                                        class="custom-control-input" value="1" disabled
                                        {{ $data_donor->pertanyaan_6 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya6">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" onclick="hideKehamilan()" id="tidak6" name="p[6]"
                                        class="custom-control-input" value="0" disabled
                                        {{ $data_donor->pertanyaan_6 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak6">Tidak</label>
                                </div>
                            </div>
                            @if ($data_donor->bulan_kehamilan != null)
                                <div class="col-12 col-lg-4 d-flex">
                                    <input type="text" class="form-control" id="bulanKehamilan"
                                        name="nama_anggota" placeholder="Masukan jumlah bulan kehamilan"
                                        value="{{ $data_donor->bulan_kehamilan }}" readonly>
                                </div>
                            @endif
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 8 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>7. Apakah anda mendonorkan darah, trombosit atau plasma?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya7" name="p[7]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_7 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya7">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak7" name="p[7]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_7 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak7">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>8. Apakah anda menerima vaksinasi atau suntikan lainnya?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya8" name="p[8]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_8 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya8">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak8" name="p[8]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_8 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak8">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>9. Apakah anda pernah kontak dengan orang yang menerima baksinasi <i>smallpox</i>?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya9" name="p[9]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_9 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya9">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak9" name="p[9]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_9 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak9">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 16 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>10. Apakah anda pernah mendonorkan 2 kantung sel darah merah melalui proses
                                    apheresis?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya10" name="p[10]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_10 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya10">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak10" name="p[10]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_10 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak10">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 12 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>11. Apakah anda pernah menerima transfuse darah?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya11" name="p[11]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_11 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya11">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak11" name="p[11]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_11 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak11">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>12. Apakah anda pernah mendapat transplantasi organ jaringan atau sumsum tulang?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya12" name="p[12]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_12 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya12">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak12" name="p[12]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_12 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak12">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>13. Apakah anda pernah cangkok tulang untuk kulit?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya13" name="p[13]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_13 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya13">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak13" name="p[13]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_13 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak13">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>14. Apakah anda pernah tertusuk jarum medis?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya14" name="p[14]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_14 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya14">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak14" name="p[14]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_14 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak14">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>15. Apakah anda pernah berhubungan seksual dengan orang HIV/AIDS?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya15" name="p[15]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_15 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya15">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak15" name="p[15]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_15 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak15">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>16. Apakah anda pernah berhubungan seksual dengan pekerja seks komersial?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya16" name="p[16]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_16 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya16">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak16" name="p[16]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_16 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak16">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>17. Apakah anda pernah berhubungan seksual dengan pengguna narkoba jarum suntik?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya17" name="p[17]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_17 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya17">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak17" name="p[17]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_17 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak17">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>18. Apakah anda pernah berhubungan seksual dengan pengguna konsentral factor
                                    pembekuan?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya18" name="p[18]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_18 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya18">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak18" name="p[18]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_18 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak18">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>19. Donor wanita: apakah anda pernah berhubungan seksual dengan laki-laki yang
                                    biseksual?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya19" name="p[19]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_19 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya19">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak19" name="p[19]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_19 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak19">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>20. Apakah anda pernah berhubungan seksual dengan penderita hepatitis?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya20" name="p[20]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_20 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya20">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak20" name="p[20]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_20 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak20">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>21. Apakah anda tinggal bersama penderita hepatitis?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya21" name="p[21]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_21 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya21">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak21" name="p[21]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_21 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak21">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>22. Apakah anda memiliki tatto?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya22" name="p[22]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_22 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya22">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak22" name="p[22]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_22 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak22">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>23. Apakah anda memiliki tindik telinga atau bagian tubuh lainnya?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya23" name="p[23]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_23 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya23">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak23" name="p[23]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_23 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak23">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>24. Apakah anda sedang atau pernah mendapat pengobatan sifilis atau GO (kencing
                                    nanah)?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya24" name="p[24]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_24 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya24">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak24" name="p[24]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_24 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak24">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>25. Apakah anda pernah ditahan dipenjara untuk waktu lebih dari 72 jam?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya25" name="p[25]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_25 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya25">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak25" name="p[25]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_25 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak25">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 3 Tahun</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>26. Apakah anda pernah berada di luar wilayah Indonesia?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya26" name="p[26]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_26 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya26">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak26" name="p[26]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_26 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak26">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1977 hingga sekarang</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>27. Apakah anda menerima uang, obat atau pembayaran lainnya untuk seks?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya27" name="p[27]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_27 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya27">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak27" name="p[27]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_27 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak27">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>28. Laki-laki : Apakah anda pernah berhubungan seksual dengan laki-laki walaupun
                                    sekali
                                    ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya28" name="p[28]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_28 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya28">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak28" name="p[28]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_28 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak28">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1980 hingga sekarang</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>29. Apakah anda tinggal selama 5 tahun atau lebih di Eropa ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya29" name="p[29]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_29 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya29">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak29" name="p[29]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_29 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak29">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>30. Apakah anda menerima transfuse darah di Inggris ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya30" name="p[30]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_30 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya30">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak30" name="p[30]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_30 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak30">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1980 hingga 1996</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>31. Apakah anda tinggal selama 3 tahun atau lebih di Inggris ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya31" name="p[31]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_31 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya31">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak31" name="p[31]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_31 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak31">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Apakah anda pernah</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>32. Mendapatkan hasil positif untuk tes HIV/AIDS ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya32" name="p[32]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_32 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya32">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak32" name="p[32]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_32 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak32">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>33. Menggunakan jarum suntik untuk obat-obatan, Steroid yang tidak diresepkan dokter
                                    ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya33" name="p[33]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_33 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya33">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak33" name="p[33]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_33 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak33">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>34. Menggunakan konsentrat factor pembekuan ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya34" name="p[34]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_34 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya34">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak34" name="p[34]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_34 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak34">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>35. Menderita hepatitis ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya35" name="p[35]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_35 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya35">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak35" name="p[35]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_35 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak35">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>36. Menderita malaria ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya36" name="p[36]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_36 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya36">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak36" name="p[36]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_36 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak36">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>37. Menderita kanker termasuk leukimia ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya37" name="p[37]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_37 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya37">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak37" name="p[37]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_37 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak37">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>38. Bermasalah dengan jantung dan pru-paru ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya38" name="p[38]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_38 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya38">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak38" name="p[38]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_38 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak38">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>39. Menderita pendarahan atau penyakit berhubungan dengan darah ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya39" name="p[39]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_39 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya39">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak39" name="p[39]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_39 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak39">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>40. Berhubungan seksual dengan orang yang tinggal di afrika ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya40" name="p[40]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_40 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya40">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak40" name="p[40]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_40 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak40">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <p>41. Tinggal di Afrika ?
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya41" name="p[41]" class="custom-control-input"
                                        value="1" disabled
                                        {{ $data_donor->pertanyaan_41 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya41">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak41" name="p[41]" class="custom-control-input"
                                        value="0" disabled
                                        {{ $data_donor->pertanyaan_41 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak41">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <hr>
                        @if ($data_donor->hasil_kusioner == 'Tidak Lolos')
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="hb">Alasan Tidak Lolos Kuesioner</label>
                                        <input type="text" class="form-control " name="hb"
                                            value="{{ $data_donor->deskripsi_hasil_kusioner }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h4>Hasil Cek Kesehatan</h4>
                            @if ($data_donor->id_petugas_kesehatan)
                                <p class="">Nama Petugas Kesehatan : {{ $data_petugas->nama }}</p>
                            @endif
                            @if ($data_donor->id_petugas_kesehatan)
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="hb">HB <small>(gram/dL)</small></label>
                                            <input type="text" class="form-control " name="hb"
                                                id="hb" placeholder="Masukan Hemoglobin"
                                                value="{{ $data_donor->hb }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="tekanan_darah">Tekanan Darah <small>(mmHg)</small></label>
                                            <input type="text" class="form-control " name="tekanan_darah"
                                                id="tekanan_darah" placeholder="Masukan Tekanan Darah"
                                                value="{{ $data_donor->tekanan_darah }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="berat_badan">Berat Badan <small>(kg)</small></label>
                                            <input type="text" class="form-control " name="berat_badan"
                                                id="berat_badan" placeholder="Masukan Berat Badan"
                                                value="{{ $data_donor->berat_badan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="tinggi_badan">Tinggi Badan <small>(cm)</small></label>
                                            <input type="text" class="form-control " name="tinggi_badan"
                                                id="tinggi_badan" placeholder="Masukan Tinggi Badan"
                                                value="{{ $data_donor->tinggi_badan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="denyut_nadi">Denyut Nadi <small>(kali per
                                                    menit)</small></label>
                                            <input type="text" class="form-control " name="denyut_nadi"
                                                id="denyut_nadi" placeholder="Masukan Denyut Nadi"
                                                value="{{ $data_donor->denyut_nadi }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="keadaan_umum">Keadaan Umum</label>
                                            <input type="text" class="form-control " name="keadaan_umum"
                                                id="keadaan_umum" placeholder="Masukan Keadaan Umum"
                                                value="{{ $data_donor->keadaan_umum }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="keadaan_umum">Catatan Pendonor</label>
                                            <input type="text" class="form-control " name="keadaan_umum"
                                                id="keadaan_umum"
                                                value="{{ $data_donor->catatan_pendonor == null ? 'Tidak ada' : $data_donor->catatan_pendonor }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>Petugas Kesehatan Belum Mengecek Kesehatan</p>
                            @endif
                        @endif
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

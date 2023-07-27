@extends('layout.v_template')

@section('content')
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

    <div class="row">
        <div class="col-xl-12 col-lg-12" data-aos="fade-up">
            <div class="card mb-4">
                @if (session('gagal'))
                    <div class="alert alert-warning alert-dismissible m-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('gagal') }}
                    </div>
                @endif
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                    <a href="/antrian" class="btn text-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
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
                                        value="{{ $data ? $data->nik : '' }}" {{ $data ? 'readonly' : '' }}> --}}
                                @error('kartu')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="nik">NIK / No. SIM</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                    name="nik" placeholder="Masukan NIK Anda" value="{{ $data_donor->nik }}" readonly>
                                {{-- <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" placeholder="Masukan NIK Anda"
                                        value="{{ $data ? $data->nik : '' }}" {{ $data ? 'readonly' : '' }}> --}}
                                @error('nik')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" placeholder="Masukan Nama" value="{{ $data_donor->nama }}"
                                    readonly>
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
                                <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror"
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
                                    class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa"
                                    placeholder="Masukan Nomor Whatsapp" value="{{ $data_donor->nomor_telepon }}" required
                                    readonly>
                                @error('no_wa')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <p>Tanggal Donor : {{ tanggal_indonesia($data_donor->tanggal_donor) }}
                                {{ date('H:i:s', strtotime($data_donor->tanggal_donor)) }}</p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <p><b>Status Kuesioner :
                                    {{ $data_donor->hasil_kusioner == 'Proses' ? 'Belum Divalidasi' : $data_donor->hasil_kusioner }}</b>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <ol>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Merasa sehat pada hari ini?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya1" name="p[1]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_1 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak1" name="p[1]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_1 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak1">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Sedang minum anti biotic?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya2" name="p[2]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_2 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya2">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak2" name="p[2]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_2 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Sedang minum obat lain untuk infeksi?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya3" name="p[3]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_3 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya3">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak3" name="p[3]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_3 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak3">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 48 jam terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda sedang minum aspirin atau obat yang mengandung aspirin?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya4" name="p[4]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_4 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya4">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak4" name="p[4]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_4 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak4">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda megalami sakit kepala dan demam bersamaan?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya5" name="p[5]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_5 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya5">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak5" name="p[5]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_5 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak5">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Untuk donor darah wanita? Apakah anda saat ini sedang hamil? Jika Ya, kehamilan
                                    dibulan ke berapa?
                                </li>
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
                                    <input type="text" class="form-control" id="bulanKehamilan" name="nama_anggota"
                                        placeholder="Masukan jumlah bulan kehamilan"
                                        value="{{ $data_donor->bulan_kehamilan }}" readonly>
                                </div>
                            @endif
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 8 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda mendonorkan darah, trombosit atau plasma?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya7" name="p[7]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_7 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya7">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak7" name="p[7]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_7 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak7">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda menerima vaksinasi atau suntikan lainnya?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya8" name="p[8]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_8 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya8">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak8" name="p[8]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_8 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak8">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah kontak dengan orang yang menerima baksinasi <i>smallpox</i>?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya9" name="p[9]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_9 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya9">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak9" name="p[9]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_9 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak9">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 16 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah mendonorkan 2 kantung sel darah merah melalui proses apheresis?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya10" name="p[10]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_10 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya10">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak10" name="p[10]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_10 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak10">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 12 minggu terakhir</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah menerima transfuse darah?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya11" name="p[11]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_11 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya11">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak11" name="p[11]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_11 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak11">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah mendapat transplantasi organ jaringan atau sumsum tulang?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya12" name="p[12]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_12 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya12">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak12" name="p[12]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_12 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak12">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah cangkok tulang untuk kulit?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya13" name="p[13]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_13 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya13">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak13" name="p[13]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_13 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak13">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah tertusuk jarum medis?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya14" name="p[14]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_14 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya14">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak14" name="p[14]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_14 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak14">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berhubungan seksual dengan orang HIV/AIDS?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya15" name="p[15]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_15 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya15">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak15" name="p[15]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_15 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak15">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berhubungan seksual dengan pekerja seks komersial?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya16" name="p[16]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_16 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya16">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak16" name="p[16]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_16 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak16">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berhubungan seksual dengan pengguna narkoba jarum suntik?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya17" name="p[17]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_17 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya17">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak17" name="p[17]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_17 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak17">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berhubungan seksual dengan pengguna konsentral factor pembekuan?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya18" name="p[18]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_18 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya18">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak18" name="p[18]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_18 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak18">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Donor wanita: apakah anda pernah berhubungan seksual dengan laki-laki yang
                                    biseksual?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya19" name="p[19]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_19 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya19">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak19" name="p[19]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_19 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak19">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berhubungan seksual dengan penderita hepatitis?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya20" name="p[20]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_20 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya20">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak20" name="p[20]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_20 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak20">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda tinggal bersama penderita hepatitis?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya21" name="p[21]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_21 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya21">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak21" name="p[21]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_21 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak21">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda memiliki tatto?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya22" name="p[22]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_22 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya22">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak22" name="p[22]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_22 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak22">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda memiliki tindik telinga atau bagian tubuh lainnya?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya23" name="p[23]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_23 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya23">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak23" name="p[23]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_23 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak23">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda sedang atau pernah mendapat pengobatan sifilis atau GO (kencing nanah)?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya24" name="p[24]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_24 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya24">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak24" name="p[24]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_24 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak24">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah ditahan dipenjara untuk waktu lebih dari 72 jam?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya25" name="p[25]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_25 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya25">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak25" name="p[25]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_25 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak25">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Dalam waktu 3 Tahun</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda pernah berada di luar wilayah Indonesia?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya26" name="p[26]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_26 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya26">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak26" name="p[26]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_26 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak26">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1977 hingga sekarang</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda menerima uang, obat atau pembayaran lainnya untuk seks?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya27" name="p[27]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_27 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya27">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak27" name="p[27]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_27 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak27">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Laki-laki : Apakah anda pernah berhubungan seksual dengan laki-laki walaupun sekali
                                    ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya28" name="p[28]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_28 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya28">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak28" name="p[28]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_28 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak28">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1980 hingga sekarang</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda tinggal selama 5 tahun atau lebih di Eropa ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya29" name="p[29]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_29 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya29">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak29" name="p[29]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_29 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak29">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda menerima transfuse darah di Inggris ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya30" name="p[30]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_30 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya30">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak30" name="p[30]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_30 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak30">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Tahun 1980 hingga 1996</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Apakah anda tinggal selama 3 tahun atau lebih di Inggris ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya31" name="p[31]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_31 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya31">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak31" name="p[31]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_31 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak31">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <b class="mb-2 pb-2">Apakah anda pernah</b>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Mendapatkan hasil positif untuk tes HIV/AIDS ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya32" name="p[32]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_32 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya32">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak32" name="p[32]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_32 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak32">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menggunakan jarum suntik untuk obat-obatan, Steroid yang tidak diresepkan dokter ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya33" name="p[33]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_33 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya33">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak33" name="p[33]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_33 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak33">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menggunakan konsentrat factor pembekuan ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya34" name="p[34]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_34 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya34">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak34" name="p[34]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_34 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak34">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menderita hepatitis ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya35" name="p[35]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_35 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya35">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak35" name="p[35]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_35 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak35">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menderita malaria ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya36" name="p[36]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_36 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya36">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak36" name="p[36]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_36 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak36">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menderita kanker termasuk leukimia ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya37" name="p[37]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_37 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya37">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak37" name="p[37]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_37 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak37">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Bermasalah dengan jantung dan pru-paru ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya38" name="p[38]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_38 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya38">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak38" name="p[38]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_38 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak38">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Menderita pendarahan atau penyakit berhubungan dengan darah ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya39" name="p[39]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_39 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya39">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak39" name="p[39]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_39 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak39">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Berhubungan seksual dengan orang yang tinggal di afrika ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya40" name="p[40]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_40 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya40">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak40" name="p[40]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_40 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak40">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-12 col-lg-8">
                                <li>Tinggal di Afrika ?
                                </li>
                            </div>
                            <div class="col-12 col-lg-4 d-flex">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="Ya41" name="p[41]" class="custom-control-input"
                                        value="1" disabled {{ $data_donor->pertanyaan_41 == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="Ya41">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tidak41" name="p[41]" class="custom-control-input"
                                        value="0" disabled {{ $data_donor->pertanyaan_41 == '0' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="tidak41">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </ol>
                    <div class="d-flex justify-content-end">
                        @if ($data_donor->hasil_kusioner == 'Proses')
                            <button class="btn btn-danger" data-toggle="modal" data-target="#btn-valid">Validasi Hasil
                                Kuesioner</button>
                        @endif
                        @if ($data_donor->hasil_kusioner != 'Tidak Lolos')
                            <a href="/cek_kesehatan/{{ $data_donor->id_donor }}" class="btn btn-danger ml-2">Cek
                                Kesehatan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal cek syarat --}}
    <div class="modal fade" id="btn-valid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validasi Kuesioner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah hasil Kuesioner telah memenuhi persyaratan untuk lanjut pemeriksaan kesehatan ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal" data-toggle="modal"
                        data-target="#btn-catatan">Tidak</button>
                    <a href="/validasi_kuesioner/{{ $data_donor->id_donor }}" class="btn btn-primary">Memenuhi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="btn-catatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan Validasi Kuesioner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/kuesioner_tidak_valid/{{ $data_donor->id_donor }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keadaan_umum">Masukan Catatan Mengapa Kuesioner Tidak Valid</label>
                            <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                                name="deskripsi_hasil_kusioner" id="catatan" placeholder="Masukan Catatan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

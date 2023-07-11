@extends('layout.v_template_front')

@section('content')
    <h1>Daftar Donor</h1>
    <div class="row">
        <div class="col-xl-12 col-lg-12" data-aos="fade-up">
            @if (session('berhasil'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('berhasil') }}
                </div>
            @endif
            @if (session('gagal'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('gagal') }}
                </div>
            @endif
            <div class="alert alert-light" role="alert">
                Mohon formulir ini diisi dengan <b>sejujurnya</b> untuk keselamatan anda dan calon penerima darah anda.
            </div>
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">KUESIONER DONOR</h6>
                </div>
                <div class="card-body">
                    <form action="/submit_kuisioner" method="POST">
                        @csrf
                        <div class="row border-bottom mb-3">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" placeholder="Masukan NIK Anda"
                                        value="{{ $data ? $data->nik : $user->nik }}" readonly>
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
                                        id="nama" name="nama" placeholder="Masukan Nama"
                                        value="{{ $data ? $data->nama_anggota : $user->nama }}" readonly>
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
                                        value="{{ $data ? $data->alamat : $user->alamat_user }}" readonly>
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
                                        value="{{ $data ? $data->jk : $user->jk }}" readonly>
                                    @error('jenis_kelamin')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="no_wa">Nomor Whatsapp</label>
                                    <input type="number" class="form-control @error('no_wa') is-invalid @enderror"
                                        id="no_wa" name="no_wa" placeholder="Masukan Nomor Whatsapp"
                                        value="{{ $user->nomor_telepon }}" required>
                                    @error('no_wa')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <ol>
                            <div class="row border-bottom mb-2 pb-2">
                                <div class="col-12 col-lg-8">
                                    <li>Merasa sehat pada hari ini?
                                    </li>
                                </div>
                                <div class="col-12 col-lg-4 d-flex">
                                    <div class="custom-control custom-radio mr-3">
                                        <input type="radio" id="Ya1" name="p[1]" class="custom-control-input"
                                            value="0">
                                        <label class="custom-control-label" for="Ya1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak1" name="p[1]" class="custom-control-input"
                                            value="1">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya2">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak2" name="p[2]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya3">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak3" name="p[3]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya4">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak4" name="p[4]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya5">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak5" name="p[5]" class="custom-control-input"
                                            value="0">
                                        <label class="custom-control-label" for="tidak5">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-bottom mb-2 pb-2">
                                <div class="col-12 col-lg-8">
                                    <li>Untuk donor darah wanita? Apakah anda saat ini sedang hamil? Jika Ya, kehamilan
                                        keberapa?
                                    </li>
                                </div>
                                <div class="col-12 col-lg-4 d-flex">
                                    <div class="custom-control custom-radio mr-3">
                                        <input type="radio" id="Ya6" name="p[6]" class="custom-control-input"
                                            value="1">
                                        <label class="custom-control-label" for="Ya6">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak6" name="p[6]" class="custom-control-input"
                                            value="0">
                                        <label class="custom-control-label" for="tidak6">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 d-flex">
                                    <input type="text" class="form-control" id="nama" name="nama_anggota"
                                        placeholder="Masukan jumlah kehamilan">
                                </div>
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya7">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak7" name="p[7]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya8">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak8" name="p[8]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya9">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak9" name="p[9]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya10">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak10" name="p[10]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya11">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak11" name="p[11]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya12">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak12" name="p[12]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya13">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak13" name="p[13]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya14">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak14" name="p[14]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya15">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak15" name="p[15]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya16">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak16" name="p[16]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya17">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak17" name="p[17]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya18">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak18" name="p[18]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya19">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak19" name="p[19]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya20">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak20" name="p[20]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya21">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak21" name="p[21]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya22">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak22" name="p[22]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya23">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak23" name="p[23]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya24">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak24" name="p[24]" class="custom-control-input"
                                            value="0">
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
                                            value="1">
                                        <label class="custom-control-label" for="Ya25">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="tidak25" name="p[25]" class="custom-control-input"
                                            value="0">
                                        <label class="custom-control-label" for="tidak25">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </ol>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary tombol d-none" data-toggle="modal" data-target="#staticBackdrop">
        Launch static backdrop modal
    </button>
    <button type="button" class="btn btn-primary cari d-none" data-toggle="modal" data-target="#searchnik">
        nik
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hai {{ $user->nama }}</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    @if (session('not_found'))
                        <div class="alert alert-danger
                         alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('not_found') }}
                        </div>
                    @endif
                    Apakah anda sudah melakukan pendonoran sebelumnya?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-none close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="quest('sudah')">Sudah</button>
                    <button type="button" class="btn btn-info" onclick="quest('belum')">Belum</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="searchnik" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cari NIK {{ $user->nama }}</h5>
                </div>
                <form action="/daftar_donor" method="get">
                    <div class="modal-body">
                        <label for="nik">Silahkan masukan NIK anda yang telah di daftarkan pada pendonoran darah
                            sebelumnya!.</label>
                        <input type="number" class="form-control" id="nik" name="nik"
                            placeholder="Masukan NIK" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary d-none close" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (!session('berhasil'))
        @if (!session('gagal'))
            <?php if (!isset($_GET['nik'])) { ?>
            <script>
                window.onload = function() {
                    $('.tombol').click();
                };

                function quest(jawaban) {
                    if (jawaban == 'sudah') {
                        $('.close').click();
                        $('.cari').click();
                    } else {
                        $('.close').click();
                    }
                }
            </script>
            <?php } ?>
        @endif
    @endif
@endsection

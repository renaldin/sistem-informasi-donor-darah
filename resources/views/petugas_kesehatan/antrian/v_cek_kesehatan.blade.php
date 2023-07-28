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
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                    <a href="/antrian" class="btn text-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <p>Nama : {{ $data_donor->nama_anggota }}</p>
                            <p>Jenis Kelamin : {{ $data_donor->jenis_kelamin }}</p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <p>Alamat : {{ $data_donor->alamat }}</p>
                            <p>Tanggal Donor : {{ tanggal_indonesia($data_donor->tanggal_donor) }}</p>

                        </div>
                    </div>
                    <hr>
                    <h4>Input Kesehatan</h4>
                    <form action="/tambah_data_kesehatan/{{ $data_donor->id_donor }}" method="POST" id="form-cek">
                        @csrf
                        <input type="hidden" name="catatan" value="" id="input-catatan">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="golda">Edit Golongan Darah</label>
                                    <select name="golda" class="form-control" id="golda">
                                        @if ($data_donor->gol_darah == null)
                                            <option value="">-- Pilih Golda --</option>
                                        @endif
                                        <option value="A" {{ $data_donor->gol_darah == 'A' ? 'selected' : '' }}>A
                                        </option>
                                        <option value="B" {{ $data_donor->gol_darah == 'B' ? 'selected' : '' }}>B
                                        </option>
                                        <option value="AB" {{ $data_donor->gol_darah == 'AB' ? 'selected' : '' }}>AB
                                        </option>
                                        <option value="O" {{ $data_donor->gol_darah == 'O' ? 'selected' : '' }}>O
                                        </option>
                                    </select>
                                    @error('hb')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="hb">HB <small>(gram/dL)</small></label>
                                    <input type="number" class="form-control @error('hb') is-invalid @enderror"
                                        name="hb" id="hb" placeholder="Masukan Hemoglobin">
                                    @error('hb')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tekanan_darah">Tekanan Darah <small>(mmHg)</small> <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="number"
                                                class="form-control @error('tekanan_darah_sistole') is-invalid @enderror"
                                                name="tekanan_darah_sistole" id="tekanan_darah"
                                                placeholder="Tekanan Darah Sistole">
                                        </div>
                                        <div class="col-1 text-center">
                                            <h2>/</h2>
                                        </div>
                                        <div class="col-5">
                                            <input type="number"
                                                class="form-control @error('tekanan_darah_diastole') is-invalid @enderror"
                                                name="tekanan_darah_diastole" id="tekanan_darah"
                                                placeholder="Tekanan Darah Diastole">
                                        </div>
                                    </div>
                                    @error('tekanan_darah_sistole')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('tekanan_darah_diastole')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="berat_badan">Berat Badan <small>(kg)</small> <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror"
                                        name="berat_badan" id="berat_badan" placeholder="Masukan Berat Badan">
                                    @error('berat_badan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tinggi_badan">Tinggi Badan <small>(cm)</small> <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror"
                                        name="tinggi_badan" id="tinggi_badan" placeholder="Masukan Tinggi Badan">
                                    @error('tinggi_badan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="denyut_nadi">Denyut Nadi <small>(kali per menit)</small> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('denyut_nadi') is-invalid @enderror"
                                        name="denyut_nadi" id="denyut_nadi" placeholder="Masukan Denyut Nadi">
                                    @error('denyut_nadi')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="keadaan_umum">Keadaan Umum <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                                        name="keadaan_umum" id="keadaan_umum" placeholder="Masukan Keadaan Umum">
                                    @error('keadaan_umum')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#btn-cek"
                            id="#myBtn">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal cek syarat --}}
    <div class="modal fade" id="btn-cek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Catatan Pendonor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah donatur memenuhi syarat donor ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal" data-toggle="modal"
                        data-target="#btn-catatan">Tidak</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('form-cek').submit();">Ya, Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="btn-catatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cek Syarat Donor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="keadaan_umum">Masukan Catatan Alasan Tidak Boleh Donor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                            name="catatan" id="catatan" placeholder="Masukan Catatan Alasan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('input-catatan').value=document.getElementById('catatan').value;document.getElementById('form-cek').submit();">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

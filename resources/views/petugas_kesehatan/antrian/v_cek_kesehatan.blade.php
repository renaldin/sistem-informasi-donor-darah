@extends('layout.v_template')

@section('content')
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
                            <p>Tanggal Donor : {{ date('d F Y H:i:s', strtotime($data_donor->tanggal_donor)) }}</p>

                        </div>
                    </div>
                    <hr>
                    <h4>Input Kesehatan</h4>
                    <form action="/tambah_data_kesehatan/{{ $data_donor->id_donor }}" method="POST">
                        @csrf
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
                                    <label for="tekanan_darah">Tekanan Darah <small>(mmHg)</small></label>
                                    <input type="text" class="form-control @error('tekanan_darah') is-invalid @enderror"
                                        name="tekanan_darah" id="tekanan_darah" placeholder="Masukan Tekanan Darah">
                                    @error('tekanan_darah')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="berat_badan">Berat Badan <small>(kg)</small></label>
                                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror"
                                        name="berat_badan" id="berat_badan" placeholder="Masukan Berat Badan">
                                    @error('berat_badan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tinggi_badan">Tinggi Badan <small>(cm)</small></label>
                                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror"
                                        name="tinggi_badan" id="tinggi_badan" placeholder="Masukan Tinggi Badan">
                                    @error('tinggi_badan')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="denyut_nadi">Denyut Nadi <small>(kali per menit)</small></label>
                                    <input type="text" class="form-control @error('denyut_nadi') is-invalid @enderror"
                                        name="denyut_nadi" id="denyut_nadi" placeholder="Masukan Denyut Nadi">
                                    @error('denyut_nadi')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="keadaan_umum">Keadaan Umum</label>
                                    <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                                        name="keadaan_umum" id="keadaan_umum" placeholder="Masukan Keadaan Umum">
                                    @error('keadaan_umum')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.v_template')

@section('content')

@php
    function tanggal_indonesia($tanggal) {
    $bulan = array(
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    
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
                    <h4>Data Kesehatan</h4>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="hb">HB <small>(gram/dL)</small></label>
                                <input type="number" class="form-control " name="hb" id="hb"
                                    placeholder="Masukan Hemoglobin" value="{{ $data_donor->hb }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="tekanan_darah">Tekanan Darah <small>(mmHg)</small></label>
                                <input type="text" class="form-control " name="tekanan_darah" id="tekanan_darah"
                                    placeholder="Masukan Tekanan Darah" value="{{ $data_donor->tekanan_darah }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="berat_badan">Berat Badan <small>(kg)</small></label>
                                <input type="number" class="form-control " name="berat_badan" id="berat_badan"
                                    placeholder="Masukan Berat Badan" value="{{ $data_donor->berat_badan }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="tinggi_badan">Tinggi Badan <small>(cm)</small></label>
                                <input type="number" class="form-control " name="tinggi_badan" id="tinggi_badan"
                                    placeholder="Masukan Tinggi Badan" value="{{ $data_donor->tinggi_badan }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="denyut_nadi">Denyut Nadi <small>(kali per menit)</small></label>
                                <input type="text" class="form-control " name="denyut_nadi" id="denyut_nadi"
                                    placeholder="Masukan Denyut Nadi" value="{{ $data_donor->denyut_nadi }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="keadaan_umum">Keadaan Umum</label>
                                <input type="text" class="form-control " name="keadaan_umum" id="keadaan_umum"
                                    placeholder="Masukan Keadaan Umum" value="{{ $data_donor->keadaan_umum }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="keadaan_umum">Catatan Pendonor</label>
                                <input type="text" class="form-control " name="keadaan_umum" id="keadaan_umum"
                                    placeholder="Masukan Keadaan Umum" value="{{ $data_donor->catatan_pendonor }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

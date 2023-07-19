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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Tanggal Donor</th>
                                <th>Nomor Antrian</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data_donor as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_anggota }}</td>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_donor) }}</td>
                                    <td>A0{{ $row->nomor_antrian }}</td>
                                    <td><span
                                            class="badge badge-{{ $row->status_donor == 'Proses' ? 'warning' : '' }}{{ $row->status_donor == 'Ready' ? 'info' : '' }}{{ $row->status_donor == 'Selesai' ? 'success' : '' }}{{ $row->status_donor == 'Gagal' ? 'danger' : '' }}">{{ $row->status_donor }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($row->status_donor == 'Selesai' || $row->status_donor == 'Ready' || $row->status_donor == 'Gagal')
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#detail{{ $row->id_donor }}">Detail</button>
                                        @elseif($row->status_donor == 'Proses' && $row->hb != null)
                                            <a href="/cek_kesehatan/{{ $row->id_donor }}/show"
                                                class="btn btn-primary btn-sm">Lihat</a>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#validasi{{ $row->id_donor }}">Validasi</button>
                                        @else
                                            <a href="/cek_kesehatan/{{ $row->id_donor }}" class="btn btn-info btn-sm">Cek
                                                Kesehatan</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($data_donor as $row)
        <div class="modal fade" id="validasi{{ $row->id_donor }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Validas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Ingin Melakukan Validasi {{ $row->nama_anggota }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <a href="/validasi/{{ $row->id_donor }}" class="btn btn-danger">Validasi</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_donor as $row)
        <div class="modal fade" id="detail{{$row->id_donor}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Cek Kesehatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <th>Hemoglobin <small>(gram/dL)</small></th>
                                <td>:</td>
                                <td>{{$row->hb}}</td>
                            </tr>
                            {{-- <tr>
                                <th>Tekanan Darah <small>(mmHg)</small></th>
                                <td>:</td>
                                <td>{{$row->tekanan_darah_sistole}} / {{$row->tekanan_darah_diastole}}</td>
                            </tr> --}}
                            <tr>
                                <th>Berat Badan <small>(kg)</small></th>
                                <td>:</td>
                                <td>{{$row->berat_badan}}</td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan <small>(cm)</small></th>
                                <td>:</td>
                                <td>{{$row->tinggi_badan}}</td>
                            </tr>
                            <tr>
                                <th>Denyut Nadi <small>(kali per menit)</small></th>
                                <td>:</td>
                                <td>{{$row->denyut_nadi}}</td>
                            </tr>
                            <tr>
                                <th>Keadaan Umum</th>
                                <td>:</td>
                                <td>{{$row->keadaan_umum}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach
@endsection

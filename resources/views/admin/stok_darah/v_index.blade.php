@extends('layout.v_template')

@section('content')
    @php
        function hitungUmur($tanggal_darah_masuk)
        {
            $tgl_lahir = new DateTime($tanggal_darah_masuk);
            $sekarang = new DateTime();
            $diff = $tgl_lahir->diff($sekarang);
            $umur_hari = $diff->days;
            $umur_jam = $diff->h;
            $umur_detik = $diff->s;
        
            $data_umur = $umur_hari . ' hari, ' . $umur_jam . ' jam, ' . $umur_detik . ' detik.';
            return $data_umur;
        }

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
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                <div class="card-header flex flex-row">
                    <table>
                        <tr>
                            <th colspan="3">Keterangan Tanggal Kedaluwarsa:</th>
                        </tr>
                        <tr>
                            <td><span class="badge badge-danger">Merah</span></td>
                            <td>:</td>
                            <td>Sudah Kedaluwarsa</td>
                        </tr>
                    </table>
                </div>
                <div class="card-header flex flex-row">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#expired">Buang Darah</button>
                </div>
                {{-- <div class="card-header flex flex-row">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Darah</button>
                    <a href="/riwayat_buang_darah" class="btn btn-danger">Darah Buang</a>
                </div> --}}
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No Kantung</th>
                                <th>Golongan Darah</th>
                                <th>Rhesus</th>
                                <th>Umur</th>
                                <th>Tanggal Kedaluwarsa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data_darah as $row)
                                @if ($row->status_darah_masuk == 'Sudah Masuk')
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->no_kantong }}</td>
                                        <td>{{ $row->golongan_darah }}</td>
                                        <td>{{ $row->resus }}</td>
                                        <td>{{ hitungUmur($row->tanggal_darah_masuk) }}</td>
                                        <td>{{$row->jenis_darah}}</td>
                                        {{-- <td>
                                            @if ($row->tanggal_kedaluwarsa < date('Y-m-d'))
                                                <span class="badge badge-danger">{{ tanggal_indonesia($row->tanggal_kedaluwarsa) }}</span>
                                            @else
                                                <span class="badge badge-success">{{ tanggal_indonesia($row->tanggal_kedaluwarsa) }}</span>
                                            @endif
                                        </td> --}}
                                        <td class="text-center">
                                            {{-- <a href="/edit_darah/{{ $row->id_darah_masuk }}"
                                                class="btn btn-sm btn-success mb-1">Edit</a> --}}
                                            <a href="/cetak_invoice_darah/{{ $row->id_darah_masuk }}"
                                                    class="btn btn-success btn-sm">Cetak</a>
                                            <button type="button" class="btn btn-sm btn-danger mb-1" data-toggle="modal"
                                                data-target="#buang{{ $row->id_darah_masuk }}">Buang</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Darah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <a href="/tambah_darah_online" class="btn btn-danger">Online</a>
                    <a href="/tambah_darah_offline" class="btn btn-danger">Offline</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($data_darah as $row)
        <div class="modal fade" id="buang{{ $row->id_darah_masuk }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buang Darah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan membuang darah dengan <strong>no kantung {{$row->no_kantong}}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <a href="/buang_darah/{{ $row->id_darah_masuk }}" class="btn btn-danger">Buang</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="expired" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kedaluwarsa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan buang semua darah yang sudah kedaluwarsa?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <a href="/buang_darah_kedaluwarsa" class="btn btn-danger">Buang</a>
                </div>
            </div>
        </div>
    </div>
@endsection

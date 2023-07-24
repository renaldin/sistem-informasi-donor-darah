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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                @if (session('berhasil'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('berhasil') }}
                    </div>
                @endif
                @if (session('gagal'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('gagal') }}
                    </div>
                @endif
                <div class="table-responsive p-3">
                    <table cellpadding='8' class="mb-2">
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $detail->nik }}</td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $detail->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $detail->nama_anggota }}</td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $detail->alamat }}</td>
                        </tr>
                    </table>
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Donor</th>
                                <th>Status</th>
                                <th>Nomor Antrian</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_donor) }}</td>
                                    <td>
                                        @if ($row->status_donor === 'Ready')
                                            Proses Input Darah
                                        @elseif ($row->status_donor === 'Proses')
                                            Proses Cek Kesehatan
                                        @elseif ($row->status_donor === 'Selesai')
                                            Selesai
                                        @elseif ($row->status_donor === 'Gagal')
                                            Gagal
                                        @endif
                                    </td>
                                    <td>A0{{ $row->nomor_antrian }}</td>
                                    <td>
                                        @if ($row->status_donor === 'Gagal')
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#detail-{{ $row->id_donor }}">Detail</button>
                                    </td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal detail --}}
    @foreach ($data as $item)
        <div class="modal fade" id="detail-{{ $item->id_donor }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <table cellpadding="5" class="mb-2">
                                <tr>
                                    <th>Hemoglobin</th>
                                    <td>:</td>
                                    <td>{{ $item->hb }} (gram/dL)</td>
                                </tr>
                                <tr>
                                    <th>Tekanan Darah</th>
                                    <td>:</td>
                                    <td>{{ $item->tekanan_darah }} (mmHg)</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>:</td>
                                    <td>{{ $item->berat_badan }} (kg)</td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <td>:</td>
                                    <td>{{ $item->tinggi_badan }} (cm)</td>
                                </tr>
                                <tr>
                                    <th>Denyut Nadi</th>
                                    <td>:</td>
                                    <td>{{ $item->denyut_nadi }} (kali per menit)</td>
                                </tr>
                                <tr>
                                    <th>Keadaan Umum</th>
                                    <td>:</td>
                                    <td>{{ $item->keadaan_umum }}</td>
                                </tr>
                            </table>
                            <label for="keadaan_umum">Alasan Anda Tidak Bisa Melakukan Donor : </label>
                            <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                                name="catatan" id="catatan" value="{{ $item->catatan_pendonor }}"
                                placeholder="Masukan Catatan Alasan" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary"
                            onclick="document.getElementById('input-catatan').value=document.getElementById('catatan').value;document.getElementById('form-cek').submit();">Simpan</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

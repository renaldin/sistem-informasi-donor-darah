@extends('layout.v_template')

@section('content')
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
                                <th>Tanggal</th>
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
                                    <td>{{ $row->tanggal_donor }}</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Catatan Alasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="keadaan_umum">Alasan Anda Tidak Bisa Melakukan Donor : </label>
                            <input type="text" class="form-control @error('keadaan_umum') is-invalid @enderror"
                                name="catatan" id="catatan" value="{{ $item->catatan_pendonor }}"
                                placeholder="Masukan Catatan Alasan" readonly>
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
    @endforeach
@endsection

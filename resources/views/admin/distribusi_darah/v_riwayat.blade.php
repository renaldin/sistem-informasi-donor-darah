@extends('layout.v_template')

@section('content')
    @php
        function hitungUmur($tanggal_darah_masuk)
        {
            $tgl_lahir = new DateTime($tanggal_darah_masuk);
            $sekarang = new DateTime();
            $diff = $tgl_lahir->diff($sekarang);
            $umur = $diff->days;

            $data_umur = $umur.' hari.';
            return $data_umur;
        }
    @endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#cetak"><i class="fas fa-fw fa-print"></i>
                        Cetak</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama RS</th>
                                <th>Tanggal</th>
                                <th>Golda</th>
                                <th>Jumlah</th>
                                <th>Status Distribusi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data_distribusi_darah as $row)
                                @if ($row->status_permohonan == 'Dikirim' || $row->status_permohonan == 'Diterima')
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama_rs }}</td>
                                        <td>{{ $row->tanggal_permohonan }}</td>
                                        <td>{{ $row->golda }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td>
                                            @if ($row->status_permohonan === 'Belum Dikirim')
                                                <span class="badge badge-danger">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Menunggu Proses')
                                                <span class="badge badge-primary">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Diterima')
                                                <span class="badge badge-success">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Dikirim')
                                                <span class="badge badge-warning">{{ $row->status_permohonan }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#detail{{ $row->id_permohonan_darah }}">Detail</button>
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

    @foreach ($data_distribusi_darah as $row)
        <div class="modal fade" id="detail{{ $row->id_permohonan_darah }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table>
                                    <tr>
                                        <th>Nama Rumah Sakit</th>
                                        <td>:</td>
                                        <td>{{ $row->nama_rs }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Dokter</th>
                                        <td>:</td>
                                        <td>{{ $row->nama_dokter }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pasien</th>
                                        <td>:</td>
                                        <td>{{ $row->nama_pasien }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Permohonan</th>
                                        <td>:</td>
                                        <td>{{ $row->tanggal_permohonan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td>:</td>
                                        <td>{{$row->golda}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah {Kantong}</th>
                                        <td>:</td>
                                        <td>{{ $row->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Permohonan</th>
                                        <td>:</td>
                                        <td>
                                            @if ($row->status_permohonan === 'Belum Dikirim')
                                                <span class="badge badge-danger">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Menunggu Proses')
                                                <span class="badge badge-primary">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Diterima')
                                                <span class="badge badge-success">{{ $row->status_permohonan }}</span>
                                            @elseif($row->status_permohonan === 'Dikirim')
                                                <span class="badge badge-warning">{{ $row->status_permohonan }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>No Kantung</th>
                                                <th>Golongan Darah</th>
                                                <th>Resus</th>
                                                <th>Umur</th>
                                                <th>Tanggal Kedaluwarsa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($data_darah_keluar as $item)
                                                @if ($row->id_permohonan_darah == $item->id_permohonan_darah)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->no_kantong }}</td>
                                                        <td>{{ $item->golongan_darah }}</td>
                                                        <td>{{ $item->resus }}</td>
                                                        <td>{{ hitungUmur($item->tanggal_darah_masuk) }}</td>
                                                        <td>{{ $item->tanggal_kedaluwarsa }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label for="upload_surat"><strong>Surat</strong></label>
                                <iframe src="{{ asset('surat_permohonan_darah/' . $row->upload_surat) }}" frameborder="0"
                                    scrolling="auto" width="100%" height="500px"></iframe>
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

    <div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rentang Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/cetak_distribusi_darah" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_mulai">Mulai Dari Tanggal</label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                name="tanggal_mulai" id="tanggal_mulai" placeholder="Masukkan Tanggal Mulai" required>
                            @error('tanggal_mulai')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">Sampai Dengan</label>
                            <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                name="tanggal_akhir" id="tanggal_akhir" placeholder="Masukkan Tanggal Akhir" required>
                            @error('tanggal_akhir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Cetak</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

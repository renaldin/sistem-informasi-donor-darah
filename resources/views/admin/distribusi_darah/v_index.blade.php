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
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="card-header flex flex-row">
                <a href="/tambah_distribusi_darah" class="btn btn-primary">Tambah Distribusi Darah</a>
              </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama RS</th>
                            <th>Tanggal Permohonan</th>
                            <th>Golda</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_distribusi_darah as $row)
                        @if ($row->status_permohonan == 'Menunggu Proses')
                          <tr>
                              <td>{{$no++}}</td>
                              <td>{{$row->nama_rs}}</td>
                              <td>{{ tanggal_indonesia($row->tanggal_permohonan) }}</td>
                              <td>{{$row->golda}}</td>
                              <td>{{$row->jumlah}}</td>
                              <td>
                                  <a href="/keluarkan_darah/{{$row->id_permohonan_darah}}" class="btn btn-sm btn-primary">Keluarkan Darah</a>
                                  <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail{{$row->id_permohonan_darah}}">Detail</button>   
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
<div class="modal fade" id="detail{{$row->id_permohonan_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <td>{{$row->nama_rs}}</td>
                    </tr>
                    <tr>
                        <th>Nama Dokter</th>
                        <td>:</td>
                        <td>{{$row->nama_dokter}}</td>
                    </tr>
                    <tr>
                        <th>Nama Pasien</th>
                        <td>:</td>
                        <td>{{$row->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Permohonan</th>
                        <td>:</td>
                        <td>{{ tanggal_indonesia($row->tanggal_permohonan) }}</td>
                    </tr>
                    <tr>
                        <th>Golongan Darah</th>
                        <td>:</td>
                        <td>{{$row->golda}}</td>
                    </tr>
                    <tr>
                        <th>Jenis Darah</th>
                        <td>:</td>
                        <td>{{$row->jenis_darah}}</td>
                    </tr>
                    <tr>
                        <th>Jumlah {Kantong}</th>
                        <td>:</td>
                        <td>{{$row->jumlah}}</td>
                    </tr>
                    <tr>
                        <th>Status Permohonan</th>
                        <td>:</td>
                        <td>
                            @if ($row->status_permohonan === 'Belum Dikirim')
                                <span class="badge badge-danger">{{$row->status_permohonan}}</span>
                                @elseif($row->status_permohonan === 'Menunggu Proses')    
                                <span class="badge badge-primary">{{$row->status_permohonan}}</span>
                                @elseif($row->status_permohonan === 'Diterima')    
                                <span class="badge badge-success">{{$row->status_permohonan}}</span>
                                @elseif($row->status_permohonan === 'Dikirim')    
                                <span class="badge badge-warning">{{$row->status_permohonan}}</span>
                            @endif    
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12 mt-3">
                <label for="upload_surat"><strong>Surat</strong></label>
                <iframe src="{{ asset('surat_permohonan_darah/'.$row->upload_surat) }}" frameborder="0" scrolling="auto" width="100%" height="500px"></iframe>
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
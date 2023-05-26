@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <th>Nama Pengaju</th>
                                <td>:</td>
                                <td>{{$detail->nama}}</td>
                            </tr>
                            <tr>
                                <th>Email Pengaju</th>
                                <td>:</td>
                                <td>{{$detail->email}}</td>
                            </tr>
                            <tr>
                                <th>Nama Instansi</th>
                                <td>:</td>
                                <td>{{$detail->nama_instansi}}</td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <td>:</td>
                                <td>{{$detail->tanggal_event}} {{$detail->jam}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Orang</th>
                                <td>:</td>
                                <td>{{$detail->jumlah_orang}}</td>
                            </tr>
                            <tr>
                                <th>Alamat Lengkap</th>
                                <td>:</td>
                                <td>{{$detail->alamat_lengkap}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>:</td>
                                <td>{{$detail->tanggal_pengajuan}}</td>
                            </tr>
                            <tr>
                                <th>Status Pengajuan</th>
                                <td>:</td>
                                <td>
                                    @if ($detail->status_pengajuan === 'Tidak Disetujui')
                                        <span class="badge badge-danger">{{$detail->status_pengajuan}}</span>
                                        @elseif($detail->status_pengajuan === 'Menunggu Persetujuan')    
                                        <span class="badge badge-primary">{{$detail->status_pengajuan}}</span>
                                        @elseif($detail->status_pengajuan === 'Disetujui')    
                                        <span class="badge badge-success">{{$detail->status_pengajuan}}</span>
                                        @elseif($detail->status_pengajuan === 'Belum Dikirim')    
                                        <span class="badge badge-warning">{{$detail->status_pengajuan}}</span>
                                    @endif    
                                </td>
                            </tr>
                            <tr>
                                <th>Status Event</th>
                                <td>:</td>
                                <td>
                                    @if ($detail->status_event === 'Aktif')
                                        <span class="badge badge-success">{{$detail->status_event}}</span>
                                        @elseif($detail->status_event === 'Tidak Aktif')    
                                        <span class="badge badge-danger">{{$detail->status_event}}</span>
                                    @endif    
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Donor</th>
                                <td>:</td>
                                <td>
                                    {{$jumlah_donor}}
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
                                    <?php $no=1;?>
                                    @foreach ($data_darah as $item)
                                    @if ($item->id_event == $detail->id_event)
                                      <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$item->no_kantong}}</td>
                                        <td>{{$item->golongan_darah}}</td>
                                        <td>{{$item->resus}}</td>
                                        <td>{{$item->tanggal_darah_masuk }}</td>
                                        <td>{{$item->tanggal_kedaluwarsa}}</td>
                                      </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label for="upload_surat"><strong>Surat</strong></label>
                        <iframe src="{{ asset('foto_surat/'.$detail->upload_surat) }}" frameborder="0" scrolling="auto" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Kantung</th>
                            <th>Golongan Darah</th>
                            <th>Resus</th>
                            <th>Tanggal Kedaluwarsa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_darah as $row)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->no_kantung}}</td>
                            <td>{{$row->golongan_darah}}</td>
                            <td>{{$row->resus}}</td>
                            <td>{{$row->tanggal_kedaluwarsa}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve{{$row->id_darah}}">Approve</button>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail{{$row->id_darah}}">Detail</button>   
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach ($data_darah as $row)
<div class="modal fade" id="approve{{$row->id_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin pengajuan event ini akan diizinkan?</p>
    </div>
    <div class="modal-footer">
      <a href="/tidak_pengajuan_event/{{$row->id_darah}}" class="btn btn-outline-danger">Tidak</a>
      <a href="/ya_pengajuan_event/{{$row->id_darah}}" class="btn btn-danger">Ya</a>
    </div>
  </div>
</div>
</div>
@endforeach

@foreach ($data_darah as $row)
<div class="modal fade" id="detail{{$row->id_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th>Nama Pengaju</th>
                    <td>:</td>
                    <td>{{$row->nama}}</td>
                </tr>
                <tr>
                    <th>Email Pengaju</th>
                    <td>:</td>
                    <td>{{$row->email}}</td>
                </tr>
                <tr>
                    <th>Nama Instansi</th>
                    <td>:</td>
                    <td>{{$row->nama_instansi}}</td>
                </tr>
                <tr>
                    <th>Waktu</th>
                    <td>:</td>
                    <td>{{$row->tanggal_event}} {{$row->jam}}</td>
                </tr>
                <tr>
                    <th>Jumlah Orang</th>
                    <td>:</td>
                    <td>{{$row->jumlah_orang}}</td>
                </tr>
                <tr>
                    <th>Alamat Lengkap</th>
                    <td>:</td>
                    <td>{{$row->alamat_lengkap}}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>:</td>
                    <td>{{$row->tanggal_pengajuan}}</td>
                </tr>
                <tr>
                    <th>Status Pengajuan</th>
                    <td>:</td>
                    <td>
                        @if ($row->status_pengajuan === 'Tidak Disetujui')
                            <span class="badge badge-danger">{{$row->status_pengajuan}}</span>
                            @elseif($row->status_pengajuan === 'Menunggu Persetujuan')    
                            <span class="badge badge-primary">{{$row->status_pengajuan}}</span>
                            @elseif($row->status_pengajuan === 'Disetujui')    
                            <span class="badge badge-success">{{$row->status_pengajuan}}</span>
                            @elseif($row->status_pengajuan === 'Belum Dikirim')    
                            <span class="badge badge-warning">{{$row->status_pengajuan}}</span>
                        @endif    
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12 mt-3">
            <label for="upload_surat"><strong>Surat</strong></label>
            <iframe src="{{ asset('foto_surat/'.$row->upload_surat) }}" frameborder="0" scrolling="auto" width="100%" height="500px"></iframe>
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
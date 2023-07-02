@extends('layout.v_template')

@section('content')

@php
function hitungUmur($tanggal_darah_masuk) {
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
                <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="card-header flex flex-row">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Darah</button>
              <a href="/riwayat_buang_darah" class="btn btn-danger">Darah Buang</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Kantung</th>
                            <th>Golongan Darah</th>
                            <th>Resus</th>
                            <th>Umur</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_darah as $row)
                        @if ($row->status_darah_masuk == 'Belum Masuk')
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$row->no_kantong}}</td>
                          <td>{{$row->golongan_darah}}</td>
                          <td>{{$row->resus}}</td>
                          <td>{{ hitungUmur($row->tanggal_darah_masuk) }}</td>
                          <td>{{date('Y-m-d', strtotime($row->tanggal_darah_masuk))}}</td>
                          <td class="text-center">
                              <button type="button" class="btn btn-sm btn-success mb-1" data-toggle="modal" data-target="#masuk{{$row->id_darah_masuk}}">Masuk</button>   
                              <button type="button" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#buang{{$row->id_darah_masuk}}">Buang</button>   
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
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="buang{{$row->id_darah_masuk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Buang Darah</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan buang darah ini?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <a href="/buang_darah/{{$row->id_darah_masuk}}" class="btn btn-danger">Buang</a>
    </div>
  </div>
</div>
</div>
@endforeach
<!-- Modal -->

@foreach ($data_darah as $row)
<div class="modal fade" id="masuk{{$row->id_darah_masuk}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Masuk Darah</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan memasukkan darah ini?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <a href="/masuk_darah/{{$row->id_darah_masuk}}" class="btn btn-success">Masuk</a>
    </div>
  </div>
</div>
</div>
@endforeach

@endsection
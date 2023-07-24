@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="card-header flex flex-row">
                <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah</a>
                {{-- <a href="/tambah_user" class="btn btn-primary">Tambah</a> --}}
            </div>
            <div class="table-responsive p-3">
                {{-- @if (session('berhasil'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('berhasil') }}
                    </div>
                @endif
                @if (session('gagal'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('gagal') }}
                    </div>
                @endif --}}
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Role</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_user as $row)
                        @if ($user->id_user !== $row->id_user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->nomor_telepon}}</td>
                                <td>
                                    @if ($row->role === 'Donatur')
                                        <span class="badge badge-danger">{{$row->role}}</span>
                                        @elseif($row->role === 'Event')    
                                        <span class="badge badge-primary">{{$row->role}}</span>
                                        @elseif($row->role === 'Petugas Kesehatan')    
                                        <span class="badge badge-warning">{{$row->role}}</span>
                                        @elseif($row->role === 'Rumah Sakit')    
                                        <span class="badge badge-success">{{$row->role}}</span>
                                        @elseif($row->role === 'Pusat PMI')    
                                        <span class="badge badge-info">{{$row->role}}</span>
                                        @elseif($row->role === 'Admin')    
                                        <span class="badge badge-secondary">{{$row->role}}</span>
                                    @endif
                                </td>
                                <td>
                                    <img class="img-profile rounded-circle" style="width: 50px;" src="@if($row->foto === null) {{ asset('foto_user/default.jpg') }} @else {{ asset('foto_user/'.$row->foto) }} @endif" alt="profile">
                                </td>
                                <td>
                                    <a href="/edit_user/{{$row->id_user}}" class="btn btn-sm btn-success">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus{{$row->id_user}}">Hapus</button>
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
@foreach ($data_user as $row)
<div class="modal fade" id="hapus{{$row->id_user}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan hapus data ini?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <a href="/hapus_user/{{$row->id_user}}" class="btn btn-danger">Hapus</a>
    </div>
  </div>
</div>
</div>
@endforeach

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
                <a href="/tambah_petugas_kesehatan" class="btn btn-primary btn-block">Petugas Kesehatan</a>
            </div>
            <div class="col-md-3">
                <a href="/tambah_donatur" class="btn btn-primary btn-block">Donatur</a>
            </div>
            <div class="col-md-3">
                <a href="/tambah_user_event" class="btn btn-primary btn-block">Event</a>
            </div>
            <div class="col-md-3">
                <a href="/tambah_rumah_sakit" class="btn btn-primary btn-block">Rumah Sakit</a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
</div>
@endsection
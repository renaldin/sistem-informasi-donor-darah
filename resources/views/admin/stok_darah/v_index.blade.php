@extends('layout.v_template')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">{{$sub_title}}</h6>
            </div>
            <div class="card-header flex flex-row">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Darah</button>
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
                            <td>{{$row->no_kantong}}</td>
                            <td>{{$row->golongan_darah}}</td>
                            <td>{{$row->resus}}</td>
                            <td>{{$row->tanggal_kedaluwarsa}}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-success">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger"">Buang</button>   
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
@endsection
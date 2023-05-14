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
                            <th>Name Instansi</th>
                            <th>Waktu Event</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_event as $row)
                        @if ($row->status_event === 'Tidak Aktif' && $row->status_pengajuan === 'Disetujui')
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_instansi}}</td>
                            <td>{{$row->tanggal_event}} {{$row->jam}}</td>
                            <td>
                                @if ($row->status_event === 'Aktif')
                                    <span class="badge badge-success">{{$row->status_event}}</span>
                                @elseif($row->status_event === 'Tidak Aktif')    
                                    <span class="badge badge-dabger">{{$row->status_event}}</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail{{$row->id_event}}">Detail</button>   
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

@foreach ($data_event as $row)
<div class="modal fade" id="detail{{$row->id_event}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <tr>
                  <th>Status Event</th>
                  <td>:</td>
                  <td>
                      @if ($row->status_event === 'Aktif')
                          <span class="badge badge-success">{{$row->status_event}}</span>
                          @elseif($row->status_event === 'Tidak Aktif')    
                          <span class="badge badge-danger">{{$row->status_event}}</span>
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
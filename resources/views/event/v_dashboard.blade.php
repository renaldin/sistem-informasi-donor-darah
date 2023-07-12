@extends('layout.v_template')

@section('content')
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#aktif">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Event Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_event_aktif }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-box fa-2x text-danger"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#tidak_aktif">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Rumah Sakit Yang Bergabung</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_event_tidak_aktif }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-building fa-2x text-danger"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- event --}}
<div class="modal fade" id="aktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Event Aktif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Data Event Aktif</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name Instansi</th>
                                    <th>Name Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Jam Mulai</th>
                                    <th>Target Pendonor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach ($data_event as $row)
                                @if ($row->status_event == 'Aktif' && $row->id_user === Session()->get('id_user'))
                                  <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->nama_instansi}}</td>
                                    <td>Nama Kegiatan</td>
                                    <td>{{$row->tanggal_event}}</td>
                                    <td>{{$row->jam}}</td>
                                    <td>{{$row->jumlah_orang}}</td>
                                  </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="tidak_aktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Event Tidak Aktif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Data Event Tidak Aktif</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name Instansi</th>
                                    <th>Name Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Jam Mulai</th>
                                    <th>Target Pendonor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach ($data_event as $row)
                                @if ($row->status_event == 'Tidak Aktif' && $row->id_user === Session()->get('id_user'))
                                  <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->nama_instansi}}</td>
                                    <td>Nama Kegiatan</td>
                                    <td>{{$row->tanggal_event}}</td>
                                    <td>{{$row->jam}}</td>
                                    <td>{{$row->jumlah_orang}}</td>
                                  </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
</div>
@endsection

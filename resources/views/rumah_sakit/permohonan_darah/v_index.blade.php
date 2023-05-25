@extends('layout.v_template')

@section('content')

@php
function hitungUmur($tanggal_darah_masuk) {
  $tgl_lahir = new DateTime($tanggal_darah_masuk);
  $sekarang = new DateTime();
  $perbedaan = $sekarang->diff($tgl_lahir);

  $umur = array(
    'tahun' => $perbedaan->y,
    'bulan' => $perbedaan->m,
    'hari' => $perbedaan->d
  );

  $data_umur = $umur['tahun'].' tahun, '.$umur['bulan'].' bulan, '.$umur['hari'].' hari.';
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
                <a href="/tambah_permohonan_darah" class="btn btn-primary">Tambah Permohonan</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Name RS</th>
                            <th>Tanggal</th>
                            <th>Golda</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_permohonan_darah as $row)
                        @if ($row->status_permohonan != 'Diterima')
                          <tr>
                              <td>{{$no++}}</td>
                              <td>{{$row->nama_rs}}</td>
                              <td>{{$row->tanggal_permohonan}}</td>
                              <td>{{$row->golda}}</td>
                              <td>{{$row->jumlah}}</td>
                              <td>
                                  @if ($row->status_permohonan === 'Belum Dikirim')
                                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#kirim{{$row->id_permohonan_darah}}">Kirim</button>
                                      <a href="/edit_permohonan_darah/{{$row->id_permohonan_darah}}" class="btn btn-sm btn-success">Edit</a>
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#batal{{$row->id_permohonan_darah}}">Batal</button>
                                  @elseif($row->status_permohonan === 'Dikirim')
                                      <button type="button" class="btn btn-xm btn-success" data-toggle="modal" data-target="#terima{{$row->id_permohonan_darah}}">Terima</button>   
                                      <button type="button" class="btn btn-xm btn-info" data-toggle="modal" data-target="#detail{{$row->id_permohonan_darah}}">Detail</button> 
                                  @else
                                      <button type="button" class="btn btn-xm btn-info" data-toggle="modal" data-target="#detail{{$row->id_permohonan_darah}}">Detail</button>   
                                  @endif
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
@foreach ($data_permohonan_darah as $row)
<div class="modal fade" id="batal{{$row->id_permohonan_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Batal</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan membatalkan data ini?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tidak</button>
      <a href="/batal_permohonan_darah/{{$row->id_permohonan_darah}}" class="btn btn-danger">Ya</a>
    </div>
  </div>
</div>
</div>
@endforeach

@foreach ($data_permohonan_darah as $row)
<div class="modal fade" id="kirim{{$row->id_permohonan_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Kirim</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan kirim permohonan darah ini?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <a href="/kirim_permohonan_darah/{{$row->id_permohonan_darah}}" class="btn btn-danger">Kirim</a>
    </div>
  </div>
</div>
</div>
@endforeach

@foreach ($data_permohonan_darah as $row)
<div class="modal fade" id="terima{{$row->id_permohonan_darah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Terima</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan terima darah?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
      <a href="/terima_permohonan_darah/{{$row->id_permohonan_darah}}" class="btn btn-danger">Terima</a>
    </div>
  </div>
</div>
</div>
@endforeach

@foreach ($data_permohonan_darah as $row)
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
                    <th>Tanggal Permohonan</th>
                    <td>:</td>
                    <td>{{$row->tanggal_permohonan}}}}</td>
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
                      @foreach ($data_darah_keluar as $item)
                      @if ($row->id_permohonan_darah == $item->id_permohonan_darah)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$item->no_kantong}}</td>
                          <td>{{$item->golongan_darah}}</td>
                          <td>{{$item->resus}}</td>
                          <td>{{ hitungUmur($item->tanggal_darah_masuk) }}</td>
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
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
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <button class="btn btn-danger" data-toggle="modal" data-target="#cetak"><i class="fas fa-fw fa-print"></i> Cetak</button>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Kantung</th>
                            <th>Golongan Darah</th>
                            <th>Resus</th>
                            <th>Tanggal Keluar</th>
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
                            <td>{{date('d F Y', strtotime($row->tanggal_keluar))}}</td>
                            <td class="text-center">
                                <a href="/edit_darah/{{$row->id_darah_keluar}}" class="btn btn-sm btn-success mb-1">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#buang{{$row->id_darah_keluar}}">Buang</button>   
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
<div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rentang Tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/cetak_darah_keluar" method="POST">
          @csrf;
          <div class="form-group">
            <label for="tanggal_mulai">Mulai Dari Tanggal</label>
            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" id="tanggal_mulai" placeholder="Masukkan Tanggal Mulai" required>
            @error('tanggal_mulai')
                <small class="form-text text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="tanggal_akhir">Sampai Dengan</label>
            <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" id="tanggal_akhir" placeholder="Masukkan Tanggal Akhir" required>
            @error('tanggal_akhir')
                <small class="form-text text-danger">{{$message}}</small>
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
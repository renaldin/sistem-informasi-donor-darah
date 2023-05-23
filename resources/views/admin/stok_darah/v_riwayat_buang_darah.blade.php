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
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Kantung</th>
                            <th>Golongan Darah</th>
                            <th>Resus</th>
                            <th>Umur</th>
                            <th>Tanggal Buang</th>
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
                            <td>{{ hitungUmur($row->tanggal_darah_masuk) }}</td>
                            <td>{{$row->tanggal_buang}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
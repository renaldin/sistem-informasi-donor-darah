@extends('layout.v_template')

@section('content')

@php
function hitungUmur($tanggal_darah) {
  $tanggal_darah_masuk = date('Y-m-d', strtotime($tanggal_darah));
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

function hitungDurasiJadwalDonor($tanggal_donor_kembali) {
  $tanggal_donor = strtotime($tanggal_donor_kembali);
  $tanggalSekarang = time();

  $durasi = floor(($tanggal_donor - $tanggalSekarang) / (60 * 60 * 24));

  return $durasi;
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
                            <th>Nama Anggota</th>
                            <th>Alamat</th>
                            <th>Jadwal Donor Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach ($data_anggota as $row)
                        @if ($row->status_anggota === 'Mandiri')
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->nama_anggota}}</td>
                            <td>{{hitungDurasiJadwalDonor($row->tanggal_donor_kembali)}}</td>
                            <td>
                              @if (hitungDurasiJadwalDonor($row->tanggal_donor_kembali) > 5)
                                <span class="badge badge-success">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                              @elseif(hitungDurasiJadwalDonor($row->tanggal_donor_kembali) > 0)
                                <span class="badge badge-warning">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                              @elseif(hitungDurasiJadwalDonor($row->tanggal_donor_kembali) <= 0)
                                <span class="badge badge-danger">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                              @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success mb-1" data-toggle="modal" data-target="#kirim_jadwal{{$row->id_anggota}}">Kirim WA</button>
                                <button type="button" class="btn btn-sm btn-warning mb-1" data-toggle="modal" data-target="#riwayat{{$row->id_anggota}}">Riwayat</button>   
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

@foreach ($data_anggota as $row)
<div class="modal fade" id="riwayat{{$row->id_anggota}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th>Nama Anggota</th>
                    <td>:</td>
                    <td>{{$row->nama_anggota}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{$row->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{$row->alamat}}</td>
                </tr>
                <tr>
                    <th>Jadwal Donor Kembali</th>
                    <td>:</td>
                    <td>{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12 mt-3">
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>No Kantung</th>
                        <th>Golongan Darah</th>
                        <th>Resus</th>
                        <th>Tanggal Donor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach ($data_darah as $item)
                      @if ($item->id_anggota === $row->id_anggota)
                        @if ($item->status_donor === 'Selesai')
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->no_kantong}}</td>
                            <td>{{$item->golongan_darah}}</td>
                            <td>{{$item->resus}}</td>
                            <td>{{date('d F Y', strtotime($item->tanggal_donor))}}</td>
                          </tr>
                        @endif
                      @endif
                    @endforeach
                </tbody>
            </table>
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
@endforeach

@foreach ($data_anggota as $row)
<div class="modal fade" id="kirim_jadwal{{$row->id_anggota}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan Whatsapp</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Apakah Anda yakin akan kirim pesan Whatsapp pemberitahuan jadwal donor kepada anggota yang bernama <strong>{{$row->nama_anggota}}</strong>?</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
      <a href="kirim_jadwal/{{$row->id_anggota}}" class="btn btn-danger">Kirim</a>
    </div>
  </div>
</div>
</div>
@endforeach

@endsection
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

  $data_umur = $umur['bulan'].' bulan, '.$umur['hari'].' hari.';
  return $data_umur;
}

function hitungDurasiJadwalDonor($tanggal_donor_kembali) {
  $tanggal_donor = strtotime($tanggal_donor_kembali);
  $tanggalSekarang = time();

  $durasi = floor(($tanggal_donor - $tanggalSekarang) / (60 * 60 * 24));

  return $durasi;
}
@endphp

    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#event">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Event Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $event }}</div>
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
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#rumah_sakit">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Rumah Sakit Yang Bergabung</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_rumah_sakit }}</div>
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

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#permohonan_darah">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Permohonan Darah (Proses)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $permohonan_darah }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-home fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#anggota">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Anggota</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggota }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#stok_darah">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Stok Darah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_stok_darah }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#darah_masuk">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Darah Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_darah_masuk }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#darah_keluar">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Darah Keluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_darah_keluar }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#darah_buang">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Darah Buang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_darah_buang }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" style="color: rgb(71, 71, 71)" data-toggle="modal" data-target="#darah_kedaluwarsa">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Darah Kedaluwarsa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_darah_kedaluwarsa }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-users fa-2x text-danger"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
              <span>Since last years</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
              <span>Since last month</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
              <span>Since yesterday</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
    </div>

    {{-- stok darah --}}
    <div class="modal fade" id="stok_darah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Stok Darah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Stok Darah</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol['a+'] == 0 ? '<span class="badge badge-danger">' . $gol['a+'] . '</span>' : $gol['a+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol['b+'] == 0 ? '<span class="badge badge-danger">' . $gol['b+'] . '</span>' : $gol['b+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol['ab+'] == 0 ? '<span class="badge badge-danger">' . $gol['ab+'] . '</span>' : $gol['ab+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol['o+'] == 0 ? '<span class="badge badge-danger">' . $gol['o+'] . '</span>' : $gol['o+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['a-'] == 0 ? '<span class="badge badge-danger">' . $gol['a-'] . '</span>' : $gol['a-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['b-'] == 0 ? '<span class="badge badge-danger">' . $gol['b-'] . '</span>' : $gol['b-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['ab-'] == 0 ? '<span class="badge badge-danger">' . $gol['ab-'] . '</span>' : $gol['ab-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['o-'] == 0 ? '<span class="badge badge-danger">' . $gol['o-'] . '</span>' : $gol['o-'] ?>
                                        </td>
                                    </tr>
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

    {{-- darah masuk --}}
    <div class="modal fade" id="darah_masuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Darah Masuk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Darah Masuk</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Jumlah Darah Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol_belum_masuk['a+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol_belum_masuk['b+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol_belum_masuk['ab+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol_belum_masuk['o+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_belum_masuk['a-']  ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_belum_masuk['b-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_belum_masuk['ab-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_belum_masuk['o-']  ?>
                                        </td>
                                    </tr>
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

    {{-- darah keluar --}}
    <div class="modal fade" id="darah_keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Darah Keluar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Darah Keluar</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Jumlah Darah Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_keluar['a+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_keluar['b+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_keluar['ab+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_keluar['o+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_keluar['a-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_keluar['b-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_keluar['ab-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_keluar['o-'] ?>
                                        </td>
                                    </tr>
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

    {{-- darah buang --}}
    <div class="modal fade" id="darah_buang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Darah Buang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Darah Buang</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Jumlah Darah Dibuang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_buang['a+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_buang['b+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_buang['ab+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol_darah_buang['o+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_buang['a-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_buang['b-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_buang['ab-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_darah_buang['o-'] ?>
                                        </td>
                                    </tr>
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

    {{-- darah Kedaluwarsa --}}
    <div class="modal fade" id="darah_kedaluwarsa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Darah Kedaluwarsa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Darah Kedaluwarsa</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Jumlah Darah Kedaluwarsa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol_kedaluwarsa['a+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol_kedaluwarsa['b+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol_kedaluwarsa['ab+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol_kedaluwarsa['o+'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_kedaluwarsa['a-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_kedaluwarsa['b-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_kedaluwarsa['ab-'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol_kedaluwarsa['o-'] ?>
                                        </td>
                                    </tr>
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

    {{-- anggota --}}
    <div class="modal fade" id="anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Anggota</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Data Anggota</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Alamat</th>
                                        <th>Jadwal Donor Kembali</th>
                                        {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($data_anggota as $row)
                                    @if ($row->status_anggota === 'Mandiri')
                                      <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->nama_anggota}}</td>
                                        <td>{{$row->alamat}}</td>
                                        <td>
                                          @if (hitungDurasiJadwalDonor($row->tanggal_donor_kembali) > 5)
                                            <span class="badge badge-success">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                                          @elseif(hitungDurasiJadwalDonor($row->tanggal_donor_kembali) > 0)
                                            <span class="badge badge-warning">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                                          @elseif(hitungDurasiJadwalDonor($row->tanggal_donor_kembali) <= 0)
                                            <span class="badge badge-danger">{{date('d F Y', strtotime($row->tanggal_donor_kembali))}}</span>
                                          @endif
                                        </td>
                                        {{-- <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-success mb-1" data-toggle="modal" data-target="#kirim_jadwal{{$row->id_anggota}}">Kirim WA</button>
                                            <button type="button" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#riwayat{{$row->id_anggota}}">Detail</button>   
                                        </td> --}}
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

    {{-- permohonan darah --}}
    <div class="modal fade" id="permohonan_darah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Permohonan Darah (Proses)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Data Permohonan Darah (Proses)</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama RS</th>
                                        <th>Tanggal</th>
                                        <th>Golda</th>
                                        <th>Rhesus</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($data_permohonan_darah as $row)
                                    @if ($row->status_permohonan == 'Menunggu Proses')
                                      <tr>
                                          <td>{{$no++}}</td>
                                          <td>{{$row->nama_rs}}</td>
                                          <td>{{$row->tanggal_permohonan}}</td>
                                          <td>{{$row->golda}}</td>
                                          <td>{{$row->rhesus}}</td>
                                          <td>{{$row->jumlah}}</td>
                                          {{-- <td>
                                              <a href="/keluarkan_darah/{{$row->id_permohonan_darah}}" class="btn btn-sm btn-primary">Keluarkan Darah</a>   
                                          </td> --}}
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

    {{-- rumah sakit --}}
    <div class="modal fade" id="rumah_sakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Rumah Sakit Yang Bergabung</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Rumah Sakit Yang Bergabung</h6>
                        </div>
                        <div class="table-responsive p-3">
                            
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Rumah Sakit</th>
                                        <th>Nomor Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($data_rumah_sakit as $row)
                                    @if ($user->id_user !== $row->id_user)
                                    @if ($row->role === 'Rumah Sakit')
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->nomor_telepon}}</td>
                                        {{-- <td>
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
                                        </td> --}}
                                        {{-- <td>
                                            <img class="img-profile rounded-circle" style="width: 50px;" src="@if($row->foto === null) {{ asset('foto_user/default.jpg') }} @else {{ asset('foto_user/'.$row->foto) }} @endif" alt="profile">
                                        </td> --}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
    </div>

    {{-- event --}}
    <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Event</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Event Yang Akan Dilaksanakan</h6>
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
                                    @if ($row->status_event == 'Aktif')
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
                    <th>Nomor Whatsapp</th>
                    <td>:</td>
                    <td>{{$row->no_wa}}</td>
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
                        <th>Rhesus</th>
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

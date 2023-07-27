@extends('layout.v_template')

@section('content')

@php
    function tanggal_indonesia($tanggal) {
            $bulan = array(
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            );
            
            $tanggal_array = explode('-', $tanggal);
            $tahun = $tanggal_array[0];
            $bulan_angka = intval($tanggal_array[1]);
            $tanggal_angka = intval($tanggal_array[2]);
            
            $tanggal_indonesia = $tanggal_angka . ' ' . $bulan[$bulan_angka - 1] . ' ' . $tahun;
            
            return $tanggal_indonesia;
        }
@endphp

    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold mb-1">Selamat datang {{ $user->nama }}. Selamat datang di
                                website Sistem Informasi Donor.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12 mb-4">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Stok Darah</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th width="100px">Golongan Darah</th>
                                        <th>Rhesus</th>
                                        <th>Stok</th>
                                        <th>Jenis Darah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td><?= $gol['a+'] == 0 ? '<span class="badge badge-danger">' . $gol['a+'] . '</span>' : $gol['a+'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['a+segar']}}</strong><br>
                                            Baru : <strong>{{$stok['a+baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['a+simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td><?= $gol['b+'] == 0 ? '<span class="badge badge-danger">' . $gol['b+'] . '</span>' : $gol['b+'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['b+segar']}}</strong><br>
                                            Baru : <strong>{{$stok['b+baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['b+simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td><?= $gol['ab+'] == 0 ? '<span class="badge badge-danger">' . $gol['ab+'] . '</span>' : $gol['ab+'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['ab+segar']}}</strong><br>
                                            Baru : <strong>{{$stok['ab+baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['ab+simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td><?= $gol['o+'] == 0 ? '<span class="badge badge-danger">' . $gol['o+'] . '</span>' : $gol['o+'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['o+segar']}}</strong><br>
                                            Baru : <strong>{{$stok['o+baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['o+simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['a-'] == 0 ? '<span class="badge badge-danger">' . $gol['a-'] . '</span>' : $gol['a-'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['a-segar']}}</strong><br>
                                            Baru : <strong>{{$stok['a-baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['a-simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['b-'] == 0 ? '<span class="badge badge-danger">' . $gol['b-'] . '</span>' : $gol['b-'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['b-segar']}}</strong><br>
                                            Baru : <strong>{{$stok['b-baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['b-simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['ab-'] == 0 ? '<span class="badge badge-danger">' . $gol['ab-'] . '</span>' : $gol['ab-'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['ab-segar']}}</strong><br>
                                            Baru : <strong>{{$stok['ab-baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['ab-simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td><?= $gol['o-'] == 0 ? '<span class="badge badge-danger">' . $gol['o-'] . '</span>' : $gol['o-'] ?>
                                        </td>
                                        <td>
                                            Segar : <strong>{{$stok['o-segar']}}</strong><br>
                                            Baru : <strong>{{$stok['o-baru']}}</strong><br>
                                            Simpan : <strong>{{$stok['o-simpan']}}</strong><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jadwal Donor Kembali</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if ($anggota !== null)
                                            {{ tanggal_indonesia($anggota->tanggal_donor_kembali) }}
                                        @else
                                            Belum Donor
                                        @endif
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

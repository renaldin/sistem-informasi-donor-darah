@extends('layout.v_template')

@section('content')
    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
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
                                        <th>Golongan Darah</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>Positif</td>
                                        <td>{{ $gol['a+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td>{{ $gol['b+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td>{{ $gol['ab+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td>{{ $gol['o+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol['a-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol['b-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol['ab-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol['o-'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Riwayat Permintaan</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Golda</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data_permohonan_darah as $row)
                                        @if ($row->status_permohonan == 'Diterima')
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->golda }}</td>
                                                <td>{{ $row->jumlah }}</td>
                                                <td>{{ $row->tanggal_permohonan }}</td>
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
    @endsection

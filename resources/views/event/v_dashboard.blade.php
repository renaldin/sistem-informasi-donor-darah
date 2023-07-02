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
                            <h6 class="m-0 font-weight-bold">Riwayat Event</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name Instansi</th>
                                        <th>Waktu Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($event as $row)
                                        @if ($row->id_user === $user->id_user && $row->status_event == 'Tidak Aktif')
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama_instansi }}</td>
                                                <td>{{ $row->tanggal_event }} {{ $row->jam }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold">Event Yang Akan Dilaksanakan</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name Instansi</th>
                                        <th>Waktu Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($event as $row)
                                        @if ($row->id_user === $user->id_user && $row->status_event == 'Aktif')
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama_instansi }}</td>
                                                <td>{{ $row->tanggal_event }} {{ $row->jam }}</td>
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
    </div>
@endsection

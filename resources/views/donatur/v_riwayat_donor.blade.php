@extends('layout.v_template')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12" data-aos="fade-up">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                @if (session('berhasil'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('berhasil') }}
                    </div>
                @endif
                <div class="table-responsive p-3">
                    <table cellpadding='8' class="mb-2">
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $detail->nik }}</td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $detail->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $detail->nama_anggota }}</td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $detail->alamat }}</td>
                        </tr>
                    </table>
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->tanggal_donor }}</td>
                                    <td>{{ $row->status_donor }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.v_template')

@section('content')
    @php
        function hitungUmur($tanggal_darah_masuk)
        {
            $tgl_lahir = new DateTime($tanggal_darah_masuk);
            $sekarang = new DateTime();
            $diff = $tgl_lahir->diff($sekarang);
            $umur_hari = $diff->days;
            $umur_jam = $diff->h;
            $umur_menit = $diff->i;
            $umur_detik = $diff->s;
        
            $data_umur = $umur_hari . ' hari, ' . $umur_jam . ' jam, '. $umur_menit . ' menit, '. $umur_detik . ' detik.';
            return $data_umur;
        }

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

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">{{ $sub_title }}</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No Kantung</th>
                                <th>Golongan Darah</th>
                                <th>Rhesus</th>
                                <th>Umur</th>
                                <th>Tanggal Buang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data_darah as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->no_kantong }}</td>
                                    <td>{{ $row->golongan_darah }}</td>
                                    <td>{{ $row->resus }}</td>
                                    <td>{{ hitungUmur($row->tanggal_darah_masuk) }}</td>
                                    <td>{{ tanggal_indonesia($row->tanggal_buang) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

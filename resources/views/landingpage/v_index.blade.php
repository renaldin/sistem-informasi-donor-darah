@extends('layout.v_template_front')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5 mt-3" data-aos="fade-right">
                <h1 class="text-uppercase text-dark font-weight-bold" style="font-weight: bolder;">Donor Darah</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem praesentium aspernatur harum
                    placeat aperiam dolores architecto iusto repellat voluptatum ex laudantium, ipsa optio, delectus
                    doloribus? Rerum ducimus ut commodi labore.</p>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center" data-aos="fade-left">
                <img src="/gambar/donor.jpg" alt="donor darah" class="w-100">
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-xl-6 col-lg-6 col-12" data-aos="fade-up">
                {{-- <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Grafik Darah Masuk</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div> --}}
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Stok Darah</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Golongan Darah</th>
                                    <th>Resus</th>
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
            <div class="col-xl-6 col-lg-6 col-12" data-aos="fade-up">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Permohonan Darah</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="chartPermohonanDarah"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-10 col-md-8 col-lg-8 text-center m-1" data-aos="fade-up">
                <h4>AGENDA (EVENT)</h4>
            </div>
            <div class="col-lg-10 col-10" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Agenda Kegiatan</h6>
                        {{-- input --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($all_event as $row)
                                <div class="col-4">
                                    <div class="card"
                                        style="background-image: url('/foto_event/{{ $row->gambar }}'); width: 100%; height: 200px; background-size: cover">
                                        <span class="mt-auto pl-2 text-white">{{ $row->nama_instansi }}</span>
                                        <span class=" pl-2 text-white">Alamat : {{ $row->alamat_lengkap }}</span>
                                        <span class=" pl-2 text-white">Tanggal :
                                            {{ date('l, d m Y', strtotime($row->tanggal_pengajuan)) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $all_event->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-10 col-md-8 col-lg-8 text-center m-1" data-aos="fade-up">
                <h4>PROSEDUR DONOR DARAH</h4>
            </div>
            <div class="col-lg-10 col-10" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 ">
                        <p style="text-indent: 4em;" align="justify">Untuk menjadi pendonor darah, ada beberapa syarat yang
                            harus dipenuhi,
                            mulai dari usia hingga
                            kondisi tubuh saat akan mendonorkan darah. Berikut ini adalah beberapa persyaratan dasar untuk
                            melakukan donor darah:
                        </p>
                        <ol>
                            <li>Berusia 17-60 tahun untuk orang yang baru pertama kali mendonorkan darah
                            <li>Pendonor pertama kali yang berusia lebih dari 60 tahun dan pendonor ulang yang berusia
                                lebih
                                dari 65 tahun dapat mendonorkan darah, tetapi mendapatkan perhatian khusus berdasarkan
                                kondisi
                                kesehatannya
                            <li>Memiliki berat badan minimal 45 kg
                            <li>Memiliki tekanan darah normal atau berkisar antara 90/60-150/80 mmHg
                            <li>Memiliki kadar hemoglobin sekitar 12,5-17 g/dL dan tidak lebih dari 20 g/dL
                            <li>Jarak waktu donor darah terakhir minimal 3 bulan atau 12 minggu, jika sebelumnya sudah
                                pernah
                                menjadi pendonor darah
                            <li>Tidak sedang dalam kondisi sakit atau memiliki keluhan tertentu, seperti lemas, batuk, atau
                                demam
                            <li>Bersedia menyumbangkan darah secara sukarela dengan menyetujui informed consent

                        </ol>
                        <p style="text-indent: 4em;" align="justify">Sebelum melakukan donor darah, pastikan kondisi tubuh
                            Anda sedang
                            sehat. Untuk menjaga kualitas darah sebelum melakukan donor darah, hindari konsumsi makanan
                            berlemak dan usahakan untuk mencukupi asupan protein, vitamin C, dan zat besi. Selain itu,
                            jangan lupa pula untuk minum air putih yang banyak. Anda juga disarankan untuk tidak melakukan
                            aktivitas fisik atau olahraga berat dan tidak mengonsumsi minuman keras setidaknya 1 hari
                            sebelum melakukan donor darah.</p>
                        <p style="text-indent: 4em;" align="justify">Selain memenuhi syarat donor darah, berikut ini adalah
                            beberapa hal yang perlu Anda perhatikan dan lakukan setelah mendonorkan darah:</p>
                        <ul>
                            <li>Jangan melepas plester pada area bekas tusukan jarum setidaknya selama 5 jam setelah donor
                                darah.
                            <li>Hindari merokok paling tidak selama 3 jam setelah donor darah.
                            <li>Hindari mengangkat barang-barang berat setidaknya 5 jam setelah donor darah.
                            <li>Perbanyak minum air putih.
                            <li>Konsumsi makanan yang kaya akan zat besi, seperti daging dan kacang-kacangan, atau suplemen
                                zat besi.

                        </ul>
                    </div>
                    {{-- <div class="card-body">
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-sm-10 col-md-8 col-lg-8 text-center m-1" data-aos="fade-up">
                <h4>PROSEDUR PERMOHONAN DARAH</h4>
            </div>
            <div class="col-lg-10 col-10" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <ol align="justify">
                            <li>Dokter pemeriksa harus membuatkan pihak keluarga pasie surat pengantar mengambil darah.
                                Surat itu berisikan: </li>
                            <ol type="a">
                                <li>Nama pasien
                                <li>Nama rumah sakit
                                <li>Golongan darah pasien
                                <li>Jenis komponen darah
                                <li>Jumlah darah yang dibutuhkan pasien

                            </ol>
                            <li> Perawat rumah sakit dan keluarga pasien membawa surat pengantar tadi ke Unit Tranfusi Darah
                                PMI.
                            <li> Petugas PMI akan memutuskan apakah mereka dapat memenuhi permintaan atau tidak dan apakah
                                mereka membutuhkan donor dari teman atau keluarga pasien sebagai ganti darah yang tidak ada.
                            <li> Untuk memastikan kebenaran info dari petugas PMI kalau stok darah habis, pihak keluarga
                                dapat
                                menghubungi langsung ke staf PMI.
                            <li> Apabila tersedia, pihak yang membutuhkan harus menunggu dulu karena darah harus melewati
                                proses uji saring dan pemisahan darah.

                        </ol>
                    </div>
                    {{-- <div class="card-body">
                    </div> --}}
                </div>
            </div>
            {{-- <div class="col-12 col-sm-10 col-md-8 col-lg-8 text-center m-1" data-aos="fade-up">
                <h4>PROSEDUR PENGAJUAN EVENT</h4>
            </div>
            <div class="col-lg-10 col-10" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Similique iure consequuntur qui? Doloribus, blanditiis voluptatum ab dicta exercitationem,
                            qui expedita architecto magni maxime labore saepe aut quis accusantium nam praesentium
                            reprehenderit odit nisi harum accusamus alias consequatur cupiditate culpa! Atque magnam
                            corporis deleniti ducimus eius consequuntur aliquid repellat praesentium voluptatum.</h6>
                    </div>
                </div>
            </div> --}}
            <div class="col-12 col-sm-10 col-md-8 col-lg-8 text-center mt-5" data-aos="fade-up">
                <p>Sistem Informasi Donor Darah memberikan informasi dan kemudahan kepada masyarakat yang ingin
                    mendonorkan darah</p>
            </div>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 text-center" data-aos="zoom-in-right"><i
                            class="bi bi-postcard-heart" style="font-size: 100px;"></i>
                        <p class="text-uppercase text-dark font-weight-bold text-center"
                            style="margin-top: -25px; font-size: large">
                            Daftar Mudah</p>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 text-center" data-aos="zoom-in-up"><i
                            class="bi bi-postcard-heart" style="font-size: 100px;"></i>
                        <p class="text-uppercase text-dark font-weight-bold text-center"
                            style="margin-top: -25px; font-size: large">
                            Proses Cepat</p>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 text-center" data-aos="zoom-in-right"><i
                            class="bi bi-postcard-heart" style="font-size: 100px;"></i>
                        <p class="text-uppercase text-dark font-weight-bold text-center"
                            style="margin-top: -25px; font-size: large">
                            Bebas Biaya</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5 mb-5 text-center">
                <a href="/daftar_donor" class="btn btn-danger btn-lg" data-aos="zoom-in-up">Daftar Menjadi Bagian</a>
            </div>
        </div>
    </div>
    <script>
        var darah_masuk = [
            <?= $darah_masuk['januari'] ?>,
            <?= $darah_masuk['februari'] ?>,
            <?= $darah_masuk['maret'] ?>,
            <?= $darah_masuk['april'] ?>,
            <?= $darah_masuk['mei'] ?>,
            <?= $darah_masuk['juni'] ?>,
            <?= $darah_masuk['juli'] ?>,
            <?= $darah_masuk['agustus'] ?>,
            <?= $darah_masuk['september'] ?>,
            <?= $darah_masuk['oktober'] ?>,
            <?= $darah_masuk['november'] ?>,
            <?= $darah_masuk['desember'] ?>,
        ];
        var event_donor = [
            <?= $event['januari'] ?>,
            <?= $event['februari'] ?>,
            <?= $event['maret'] ?>,
            <?= $event['april'] ?>,
            <?= $event['mei'] ?>,
            <?= $event['juni'] ?>,
            <?= $event['juli'] ?>,
            <?= $event['agustus'] ?>,
            <?= $event['september'] ?>,
            <?= $event['oktober'] ?>,
            <?= $event['november'] ?>,
            <?= $event['desember'] ?>,
        ];
        var permohonan_darah = [
            <?= $permohonan_darah['januari'] ?>,
            <?= $permohonan_darah['februari'] ?>,
            <?= $permohonan_darah['maret'] ?>,
            <?= $permohonan_darah['april'] ?>,
            <?= $permohonan_darah['mei'] ?>,
            <?= $permohonan_darah['juni'] ?>,
            <?= $permohonan_darah['juli'] ?>,
            <?= $permohonan_darah['agustus'] ?>,
            <?= $permohonan_darah['september'] ?>,
            <?= $permohonan_darah['oktober'] ?>,
            <?= $permohonan_darah['november'] ?>,
            <?= $permohonan_darah['desember'] ?>,
        ];
    </script>
@endsection

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
                <p align="justify">Donor darah adalah prosedur sukarela yang dapat membantu menyelamatkan nyawa orang lain.
                    Darah dari setiap pendonor akan dikumpulkan lewat jarum steril sekali pakai, kemudian ditampung dalam
                    kantong darah steril. Prosedur ini bisa jadi dilakukan dengan menyumbangkan darah utuh atau komponen
                    darah tertentu, seperti trombosit atau plasma. Jumlah yang diberikan dalam prosedur donor darah komponen
                    darah tertentu ini akan bergantung pada tinggi badan, berat badan, dan jumlah trombosit Anda.</p>
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
            <div class="col-xl-6 col-lg-6 col-12" data-aos="fade-up">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Permohonan Darah</h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Jumlah Permohonan</th>
                                            <th>Golda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Januari</td>
                                            <td>{{ $permohonan_darah['januari'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldajan'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Februari</td>
                                            <td>{{ $permohonan_darah['februari'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldafeb'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Maret</td>
                                            <td>{{ $permohonan_darah['maret'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldamar'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>April</td>
                                            <td>{{ $permohonan_darah['april'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldaapr'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>Mei</td>
                                            <td>{{ $permohonan_darah['mei'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldamei'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>Juni</td>
                                            <td>{{ $permohonan_darah['juni'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldajun'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td>Juli</td>
                                            <td>{{ $permohonan_darah['juli'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldajul'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8.</td>
                                            <td>Agustus</td>
                                            <td>{{ $permohonan_darah['agustus'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldaagu'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9.</td>
                                            <td>September</td>
                                            <td>{{ $permohonan_darah['september'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldasep'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>Oktober</td>
                                            <td>{{ $permohonan_darah['oktober'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldaokt'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11.</td>
                                            <td>November</td>
                                            <td>{{ $permohonan_darah['november'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldanov'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12.</td>
                                            <td>Desember</td>
                                            <td>{{ $permohonan_darah['desember'] }}</td>
                                            <td>
                                                @foreach ($golda_permohonan['goldades'] as $item)
                                                    {{ $item->golda }}
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                        style="background-image: url('/foto_biodata/logo-pmi.png'); width: 100%; height: 200px; background-size: cover">
                                        <span class="mt-auto pl-2 text-black">{{ $row->nama_instansi }}</span>
                                        <span class=" pl-2 text-black">Alamat : {{ $row->alamat_lengkap }}</span>
                                        <span class=" pl-2 text-black">Tanggal :
                                            {{ date('l, d m Y', strtotime($row->tanggal_pengajuan)) }}</span>
                                        <span class=" pl-2 text-black">Jam : {{ $row->jam }}</span>
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
                <h4><b>INFORMASI</b></h4>
            </div>
            <div class="col-lg-12 col-12" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 ">
                        <div class="row">
                            <div class="col-lg-4">
                                <style>
                                    a.side-info:hover {
                                        color: red !important;
                                        cursor: pointer;
                                    }
                                </style>
                                <hr class="sidebar-divider">
                                <div class="sidebar-heading">
                                    <a class="nav-link side-info" id="manfaat">
                                        <span>Informasi Manfaat Donor</span>
                                    </a>
                                </div>
                                <hr class="sidebar-divider">
                                <div class="sidebar-heading">
                                    <a class="nav-link side-info" id="prosedur">
                                        <span>Informasi Prosedur Donor</span>
                                    </a>
                                </div>
                                <hr class="sidebar-divider">
                                <div class="sidebar-heading">
                                    <a class="nav-link side-info" id="permohonan">
                                        <span>Informasi Prosedur Permohonan Darah</span>
                                    </a>
                                </div>
                                <hr class="sidebar-divider">
                                <div class="sidebar-heading">
                                    <a class="nav-link side-info" id="urgent">
                                        <span>Informasi Darah Urgent</span>
                                    </a>
                                </div>
                                <hr class="sidebar-divider">
                            </div>
                            <div class="col-lg-8">
                                <div class="manfaat">
                                    <h4><b>Informasi Manfaat Donor</b></h4>
                                    <p class="text-danger">Manfaat Donor Darah</p>
                                    <p>Pernahkah Anda melakukan donor darah? Beruntunglah jika pernah atau bahkan rutin
                                        melakukannya berikut ini manfaat dari donor darah: </p>
                                    <ol>
                                        <li>Bentuk kepedulian terhadap sesama
                                        <li>Memperpanjang hidup oran lain.
                                        <li>Membantu hidup orang lain.
                                        <li>Satu kantong darah dapat menyelamatkan 3 nyawa
                                        <li>Membantu menurunkan berat badan
                                        <li>Membantu membakar kalori
                                        <li>Deteksi dini resiko kesehatan
                                        <li>Melindungi jantung
                                        <li>Mencegah stroke
                                        <li>Mengatur kontrol kesehatan
                                        <li>Meningkatkan sel darah merah
                                        <li>Meningkatkan kapasitas paru-paru dan ginjal
                                        <li>Meningkatkan kesehatan psikologis
                                        <li>Membantu sirkulasi darah
                                        <li>Memaksimalkan darah dalam paru-paru
                                        <li>Menurunkan zat seng dalam darah
                                        <li>Memperbaharui sel darah baru
                                        <li>Mencegah resiko kesehatan
                                        <li>Mencegah penyakit langka
                                        <li>Menghilangkan kaku di pundak
                                        <li>Mengalahkan kelebihan zat besi
                                        <li>Mengetahui lebih lanjut tentang tipe darah individu
                                    </ol>
                                </div>
                                <div class="prosedur d-none">
                                    <h4><b>Informasi Prosedur Donor</b></h4>
                                    <p class="text-danger">Jika Anda sudah memenuhi syarat untuk donor darah, yuk simak
                                        tahapan-tahapan dalam mendonorkan darah :</p>
                                    <ol>
                                        <b>
                                            <li>Tahap Registrasi
                                        </b>
                                        <ul>
                                            <li>Mengisi formulir pendaftaran dan kuisioner kesehatan</li>
                                        </ul>
                                        <b>
                                            <li>Tahap Pemeriksaan Pendahuluan
                                        </b>
                                        <ul>
                                            <li>Pengukuran berat badan
                                            <li>Pemeriksaan kadar haemoglobin darah
                                            <li>Pemeriksaan golongan darah bagi pendonor pemula
                                        </ul>
                                        <b>
                                            <li>Tahap Pemeriksaan Kesehatan oleh Dokter
                                        </b>
                                        <ul>
                                            <li>Anamnesis
                                            <li>Pemeriksaan tekanan darah
                                            <li>Pemeriksaan fisik sederhana
                                        </ul>
                                        <b>
                                            <li>Tahap Pengambilan Darah Donor
                                        </b>
                                        <ul>
                                            <li>Cuci lengan donor
                                            <li>Pengambilan darah
                                            <li>Pengambilan sampel darah
                                        </ul>
                                        <b>
                                            <li>Tahap Administrasi
                                        </b>
                                        <ul>
                                            <li>Mengambil kartu donor dan vitamin
                                        </ul>
                                        <b>
                                            <li>Tahap Pemulihan
                                        </b>
                                        <ul>
                                            <li>Pendonor dianjurkan untuk istirahat dan menikmati hidangan ringan yang kami
                                                sajikan
                                        </ul>
                                    </ol>
                                    <p><b>Persyaratan donor darah dapat kamu lihat disini : <a href="/syarat_donor"
                                                class="text-decoration-none">syarat
                                                donor</a></b></p>
                                </div>
                                <div class="permohonan d-none">
                                    <h4><b>Informasi Prosedur Permohonan Donor</b></h4>
                                    <p class="text-danger">Prosedur Permohonan Darah</p>
                                    <ol align="justify">
                                        <li>Dokter pemeriksa harus membuatkan pihak keluarga pasie surat pengantar mengambil
                                            darah.
                                            Surat itu berisikan: </li>
                                        <ol type="a">
                                            <li>Nama pasien
                                            <li>Nama rumah sakit
                                            <li>Golongan darah pasien
                                            <li>Jenis komponen darah
                                            <li>Jumlah darah yang dibutuhkan pasien

                                        </ol>
                                        <li> Perawat rumah sakit dan keluarga pasien membawa surat pengantar tadi ke Unit
                                            Tranfusi Darah
                                            PMI.
                                        <li> Petugas PMI akan memutuskan apakah mereka dapat memenuhi permintaan atau tidak
                                            dan
                                            apakah
                                            mereka membutuhkan donor dari teman atau keluarga pasien sebagai ganti darah
                                            yang
                                            tidak ada.
                                        <li> Untuk memastikan kebenaran info dari petugas PMI kalau stok darah habis, pihak
                                            keluarga
                                            dapat
                                            menghubungi langsung ke staf PMI.
                                        <li> Apabila tersedia, pihak yang membutuhkan harus menunggu dulu karena darah harus
                                            melewati
                                            proses uji saring dan pemisahan darah.

                                    </ol>
                                    <img src="{{ asset('gambar/permohonan-darah.png') }}" alt="permohonan darah"
                                        class="w-100">
                                </div>
                                <div class="urgent d-none">
                                    <h4><b>Informasi Darah Urgent</b></h4>
                                    <p class="text-danger">Darah Urgent yaitu darah yang saat ini sedang dibutuhkan atau
                                        darah sedang kosong.</p>
                                </div>
                            </div>
                        </div>

                        {{-- <p style="text-indent: 4em;" align="justify">Sebelum melakukan donor darah, pastikan kondisi tubuh
                            Anda sedang
                            sehat. Untuk menjaga kualitas darah sebelum melakukan donor darah, hindari konsumsi makanan
                            berlemak dan usahakan untuk mencukupi asupan protein, vitamin C, dan zat besi. Selain itu,
                            jangan lupa pula untuk minum air putih yang banyak. Anda juga disarankan untuk tidak melakukan
                            aktivitas fisik atau olahraga berat dan tidak mengonsumsi minuman keras setidaknya 1 hari
                            sebelum melakukan donor darah.</p>
                        <p style="text-indent: 4em;" align="justify">Selain memenuhi syarat donor darah, berikut ini
                            adalah
                            beberapa hal yang perlu Anda perhatikan dan lakukan setelah mendonorkan darah:</p>
                        <ul>
                            <li>Jangan melepas plester pada area bekas tusukan jarum setidaknya selama 5 jam setelah donor
                                darah.
                            <li>Hindari merokok paling tidak selama 3 jam setelah donor darah.
                            <li>Hindari mengangkat barang-barang berat setidaknya 5 jam setelah donor darah.
                            <li>Perbanyak minum air putih.
                            <li>Konsumsi makanan yang kaya akan zat besi, seperti daging dan kacang-kacangan, atau suplemen
                                zat besi.

                        </ul> --}}
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
                            Layanan Permohonan Darah</p>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 text-center" data-aos="zoom-in-up"><i
                            class="bi bi-calendar-event" style="font-size: 100px;"></i>
                        <p class="text-uppercase text-dark font-weight-bold text-center"
                            style="margin-top: -25px; font-size: large">
                            Layanan Pengajuan Event</p>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 text-center" data-aos="zoom-in-right"><i
                            class="bi bi-calendar-heart" style="font-size: 100px;"></i>
                        <p class="text-uppercase text-dark font-weight-bold text-center"
                            style="margin-top: -25px; font-size: large">
                            Layanan Pendonoran Darah</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5 mb-5 text-center">
                <a href="/register" class="btn btn-danger btn-lg" data-aos="zoom-in-up">Daftar</a>
            </div>
        </div>
    </div>

    {{-- javascript untuk konten informasi --}}
    <script>
        $('#prosedur').on('click', function() {
            $('.manfaat').addClass('d-none')
            $('.permohonan').addClass('d-none')
            $('.urgent').addClass('d-none')
            $('.prosedur').removeClass('d-none')
            $('#manfaat').removeClass('text-danger')
            $('#permohonan').removeClass('text-danger')
            $('#urgent').removeClass('text-danger')
            $(this).addClass('text-danger')
        })
        $('#manfaat').on('click', function() {
            $('.prosedur').addClass('d-none')
            $('.permohonan').addClass('d-none')
            $('.urgent').addClass('d-none')
            $('.manfaat').removeClass('d-none')
            $('#prosedur').removeClass('text-danger')
            $('#permohonan').removeClass('text-danger')
            $('#urgent').removeClass('text-danger')
            $(this).addClass('text-danger')
        })
        $('#permohonan').on('click', function() {
            $('.prosedur').addClass('d-none')
            $('.manfaat').addClass('d-none')
            $('.urgent').addClass('d-none')
            $('.permohonan').removeClass('d-none')
            $('#prosedur').removeClass('text-danger')
            $('#manfaat').removeClass('text-danger')
            $('#urgent').removeClass('text-danger')
            $(this).addClass('text-danger')
        })
        $('#urgent').on('click', function() {
            $('.prosedur').addClass('d-none')
            $('.manfaat').addClass('d-none')
            $('.permohonan').addClass('d-none')
            $('.urgent').removeClass('d-none')
            $('#prosedur').removeClass('text-danger')
            $('#manfaat').removeClass('text-danger')
            $('#permohonan').removeClass('text-danger')
            $(this).addClass('text-danger')
        })
    </script>
@endsection

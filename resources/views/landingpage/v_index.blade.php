@extends('layout.v_template_front')

@section('content')
    <div class="container">
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
            <div class="col-xl-12 col-lg-12" data-aos="fade-up">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Data Stok Darah</h6>
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
                </div>
            </div>
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
@endsection

@extends('layout.v_template')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>@yield('title')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
          <li class="breadcrumb-item active">{{$subTitle}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section dashboard">
      <div class="row">
  
        <!-- Left side columns -->
        <div class="col-lg-9">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
  
                <div class="card-body">
                  <h5 class="card-title">Jumlah User</h5>
  
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>77</h6>
                    </div>
                  </div>
                </div>
  
              </div>
            </div>
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
  
                <div class="card-body">
                  <h5 class="card-title">Pemasukan</h5>
  
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-intersect"></i>
                    </div>
                    <div class="ps-3">
                      <h6>66</h6>
                    </div>
                  </div>
                </div>
  
              </div>
            </div>
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
  
                <div class="card-body">
                  <h5 class="card-title">Pengeluaran</h5>
  
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-layers"></i>
                    </div>
                    <div class="ps-3">
                      <h6>77</h6>
                    </div>
                  </div>
                </div>
  
              </div>
            </div>
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
  
                <div class="card-body">
                  <div class="row">
                    <div class="col-xxl-8 col-md-6 d-flex align-items-center justify-content-center ">
                      <img src="{{ asset('layout') }}/assets/img/logo.png" alt="Logo" width="100px">
                    </div>
                    <div class="col-xxl-4 col-md-6">
                      <div class="info-card sales-card">
  
                        <div class="card-body">
                          <h5 class="card-title">Jumlah Siswa</h5>
          
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-boxes"></i>
                            </div>
                            <div class="ps-3">
                              <h6>988</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
  
                    <div class="col-xxl-12 col-md-12">
                      <h3><strong>Welcome {{$user->nama}}</strong></h3>
                      <h5 >Selamat datang di website SPP. Anda login sebagai {{$user->role}}.</h5>
                    </div>
  
                  </div>
                </div>
  
              </div>
            </div><!-- End Reports -->
          </div>
        </div><!-- End Left side columns -->
  
        <!-- Right side columns -->
        <div class="col-lg-3">
  
          <!-- Recent Activity -->
          <div class="card">
  
            <div class="card-body">
              <h5 class="card-title">Catatan Baru</h5>
  
              <div class="activity">
{{--   
                @foreach ($news as $item)
                <div class="activity-item d-flex">
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    <strong>{{ $item->title }}</strong> - {{ $item->date }}
                  </div>
                </div>
                @endforeach --}}
  
              </div>
  
            </div>
          </div><!-- End Recent Activity -->
        </div><!-- End Right side columns -->
  
      </div>
    </section>
  
  </main>
@endsection

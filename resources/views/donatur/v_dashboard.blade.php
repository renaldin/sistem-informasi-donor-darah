@extends('layout.v_template')

@section('content')
<div class="row mb-3">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-12 col-md-12 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xl font-weight-bold mb-1">Selamat datang {{$user->nama}}. Selamat datang di website Sistem Informasi Donor.</div>
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
              <table class="table align-items-center table-flush table-hover" id="dataTableHover">
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
                          <td>{{ $gol['a'] }}</td>
                      </tr>
                      <tr>
                          <td>2</td>
                          <td>B</td>
                          <td>{{ $gol['b'] }}</td>
                      </tr>
                      <tr>
                          <td>3</td>
                          <td>AB</td>
                          <td>{{ $gol['ab'] }}</td>
                      </tr>
                      <tr>
                          <td>4</td>
                          <td>O</td>
                          <td>{{ $gol['o'] }}</td>
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
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d F Y', strtotime($anggota->tanggal_donor_kembali))}}</div>
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

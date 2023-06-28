@extends('layout.v_template')

@section('content')
    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Event Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $event }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Event Tidak Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $event_tidak_aktif }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Permohonan Darah (Proses)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $permohonan_darah }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggota }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
              <span>Since last years</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
              <span>Since last month</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            <div class="mt-2 mb-0 text-muted text-xs">
              <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
              <span>Since yesterday</span>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

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
                                        <th>Resus</th>
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
                            <h6 class="m-0 font-weight-bold">Darah Masuk</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
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
                                        <td>{{ $gol_belum_masuk['a+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B</td>
                                        <td>Positif</td>
                                        <td>{{ $gol_belum_masuk['b+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>AB</td>
                                        <td>Positif</td>
                                        <td>{{ $gol_belum_masuk['ab+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>O</td>
                                        <td>Positif</td>
                                        <td>{{ $gol_belum_masuk['o+'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>A</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol_belum_masuk['a-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>B</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol_belum_masuk['b-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>AB</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol_belum_masuk['ab-'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>O</td>
                                        <td>Negatif</td>
                                        <td>{{ $gol_belum_masuk['o-'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

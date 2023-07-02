
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('template/img/logo/logo.png') }}" rel="icon">
  <title>{{$title}} - Sistem Donor</title>
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">

  <style>
    .main-img {
        background: url("{{asset("gambar/bg-login.png")}}");
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
        width: 100%;
    }
  </style>
</head>

<body class="bg-gradient-login">
  @include('sweetalert::alert')
  <!-- Login Content -->
  <main class="main-img">
    <div class="container-login">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
          <div class="card shadow-sm" style="@if($register === 'Pilihan') margin-top: 170px @else margin-top: 90px @endif">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div class="login-form">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900">{{$title}}</h1>
                      <p class="text-gray-900 mb-4">Silahkan masukkan data Anda.</p>
                    </div>
                    
                    <form class="user" method="POST" action="/register" >
                      @csrf

                      @if ($register === 'Donatur')

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" placeholder="Masukkan Nama Lengkap" required>
                              <input type="hidden" name="role" class="form-control" value="Donatur">
                              @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="alamat_user" class="form-control @error('alamat_user') is-invalid @enderror" value="{{old('alamat_user')}}" placeholder="Masukkan Alamat Lengkap" required>
                              @error('alamat_user')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{old('nik')}}" placeholder="Masukkan NIK" required>
                              @error('nik')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{old('tanggal_lahir')}}" placeholder="Masukkan Tanggal Lahir" required>
                              @error('tanggal_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <input type="number" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{old('nomor_telepon')}}" placeholder="Nomor Telepon" required>
                              @error('nomor_telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <select name="jk" class="form-control @error('jk') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                              @error('jk')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <select name="gol_darah" class="form-control @error('gol_darah') is-invalid @enderror">
                                <option value="">-- Pilih Gol Darah (Opsional) --</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="B">B</option>
                                <option value="O">O</option>
                              </select>
                              @error('gol_darah')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Masukkan Alamat Email" required>
                              @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                              @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <button type="submit"  class="btn btn-danger btn-block">Register</button>
                          </div>
                        </div>

                      @elseif ($register === 'Event')

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="kode_instansi" class="form-control @error('kode_instansi') is-invalid @enderror" value="{{old('kode_instansi')}}" placeholder="Masukkan Kode Instansi" required>
                              <input type="hidden" name="role" class="form-control" value="Event">
                              @error('kode_instansi')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" placeholder="Masukkan Nama Instansi" required>
                              @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="number" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{old('nomor_telepon')}}" placeholder="Masukkan Nomor Telepon" required>
                              @error('nomor_telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="alamat_user" class="form-control @error('alamat_user') is-invalid @enderror" value="{{old('alamat_user')}}" placeholder="Masukkan Alamat Lengkap" required>
                              @error('alamat_user')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Masukkan Alamat Email" required>
                              @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                              @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <button type="submit"  class="btn btn-danger btn-block">Register</button>
                          </div>
                        </div>

                      @elseif ($register === 'Rumah Sakit')

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="kode_rs" class="form-control @error('kode_rs') is-invalid @enderror" value="{{old('kode_rs')}}" placeholder="Masukkan Kode Rumah Sakit" required>
                              <input type="hidden" name="role" class="form-control" value="Rumah Sakit">
                              @error('kode_rs')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" placeholder="Masukkan Nama Rumah Sakit" required>
                              @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="number" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{old('nomor_telepon')}}" placeholder="Masukkan Nomor Telepon" required>
                              @error('nomor_telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="text" name="alamat_user" class="form-control @error('alamat_user') is-invalid @enderror" value="{{old('alamat_user')}}" placeholder="Masukkan Alamat Lengkap" required>
                              @error('alamat_user')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Masukkan Alamat Email" required>
                              @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                              @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <button type="submit"  class="btn btn-danger btn-block">Register</button>
                          </div>
                        </div>

                      @else
                        <div class="row">
                          <div class="col-lg-4">
                            <a href="/register_donatur" class="btn btn-danger btn-block">Donatur</a>
                          </div>
                          <div class="col-lg-4">
                            <a href="/register_event" class="btn btn-danger btn-block">Event</a>
                          </div>
                          <div class="col-lg-4">
                            <a href="/register_rumah_sakit" class="btn btn-danger btn-block">Rumah Sakit</a>
                          </div>
                        </div>
                      @endif
                    </form>

                    <hr>
                    <div class="text-center">
                      <a class="font-weight-bold small text-gray-900" href="/login">Sudah punya akun? Login!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Login Content -->
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
</body>

</html>
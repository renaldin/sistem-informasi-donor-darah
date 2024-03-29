
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
  <!-- Login Content -->
  <main class="main-img">
    <div class="container-login">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
          <div class="card shadow-sm" style="margin-top: 90px">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div class="login-form">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900">{{$title}}</h1>
                      <p class="text-gray-900 mb-4">Silahkan masukkan data Anda.</p>
                    </div>
                    <div>
                      @if (session('berhasil'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('berhasil') }}
                      </div>
                      @endif
                      @if (session('gagal'))
                      <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('gagal') }}
                      </div>
                      @endif
                    </div>
                    <form class="user" method="POST" action="/register" >
                      @csrf
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" placeholder="Masukkan Nama Lengkap">
                            @error('nama')
                              <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="number" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{old('nomor_telepon')}}" placeholder="Masukkan Nomor Telepon">
                            @error('nomor_telepon')
                              <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Masukkan Alamat Email">
                            @error('email')
                              <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                            @error('password')
                              <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                              <option value="">-- Pilih Role --</option>
                              <option value="Donatur">Donatur</option>
                              <option value="Event">Event</option>
                              <option value="Rumah Sakit">Rumah Sakit</option>
                            </select>
                            @error('role')
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
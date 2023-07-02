
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('foto_biodata/logo-pmi.png') }}" rel="icon">
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
          <div class="card shadow-sm" style="margin-top: 120px">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div class="login-form">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900">{{$title}}</h1>
                      <p class="text-gray-900 mb-4">Silahkan masukkan data Email dan Paassword</p>
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
                    <form class="user" method="POST" action="/login" >
                      @csrf
                      <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Alamat Email">
                        @error('email')
                          <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                        @error('password')
                          <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <button type="submit"  class="btn btn-danger btn-block">Login</button>
                      </div>
                      <div class="form-group text-right">
                        <a href="/lupa_password">Lupa Password</a>
                      </div>
                      <hr>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="font-weight-bold small text-gray-900" href="/register">Belum punya akun? Register!</a>
                    </div>
                    <div class="text-center">
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
<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top"
    style="background-color: rgb(252, 84, 75);">
    <a class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none" href="/">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('template/img/logo/logo2.png') }}" width="40px">
        </div>
        <div class="sidebar-brand-text mx-3 text-white"><b>{{ $data_web->nama_website }}</b></div>
    </a>
    {{-- nav on windows --}}
    <ul class="navbar-nav ml-auto menu-nav">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="/">
                <span>Home</span>
            </a>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="/daftar_donor">
                <span>Daftar Donor</span>
            </a>
        </li>
        @if ($user != null && $user->role === 'Donatur')
            {{-- <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn">
                    <span>Riwayat Donor</span>
                </a>
            </li> --}}
        @endif
        <div class="topbar-divider d-none d-sm-block"></div>
        @if ($user != null && $user->role === 'Donatur')
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                        src="@if ($user->foto !== null) {{ asset('foto_user/' . $user->foto) }} @else {{ asset('foto_user/default.jpg') }} @endif"
                        style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small">{{ $user->nama }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/dashboard">
                        <i class="fas fa-fw fa-palette mr-2 text-gray-400"></i>
                        Dashboard
                    </a>
                    <a class="dropdown-item" href="/profil">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil
                    </a>
                    <a class="dropdown-item" href="/ubah_password">
                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ubah Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </div>
            </li>
        @else
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link " href="/dashboard">
                    Dashboard
                    <i class="fas fa-fw fa-tachometer-alt fa-sm fa-fw ml-2 text-gray-400"></i>
                </a>
                <a class="nav-link " href="/login" class="btn btn-info">
                    <span>Login</span>
                </a>
                {{-- <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
            </a> --}}
            </li>
        @endif
    </ul>
    {{-- nav on mobile --}}
    <div class="nav-item dropdown no-arrow ml-auto button-nav d-none">
        <button id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Home
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/daftar_donor">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Daftar Donor
            </a>
            @if ($user != null && $user->role === 'Donatur')
                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal" id="#myBtn">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Riwayat Donor
                </a> --}}
            @endif
            <div class="dropdown-divider"></div>
            @if ($user != null && $user->role === 'Donatur')
                <a class="dropdown-item" href="/dashboard">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Dashboard
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            @else
                <a class="dropdown-item" href="/login">
                    <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Login
                </a>
            @endif
            {{-- <button type="button" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </button> --}}
        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan NIK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/riwayat_donor" method="get">
                <div class="modal-body">
                    <input type="number" class="form-control" id="nik" name="nik"
                        placeholder="Masukan NIK Anda." required autofocus>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>

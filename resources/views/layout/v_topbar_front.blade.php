<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top"
    style="background-color: rgb(252, 84, 75);">
    <a class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none" href="/">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('template/img/logo/logo2.png') }}" width="40px">
        </div>
        <div class="sidebar-brand-text mx-3 text-white"><b>{{ $data_web->nama_website }}</b></div>
    </a>
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
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            @if ($user != null && $user->role === 'Donatur')
                <a class="nav-link " href="#" data-toggle="modal" data-target="#logoutModal">
                    Logout
                    <i class="fas fa-sign-out-alt fa-sm fa-fw ml-2 text-gray-400"></i>
                </a>
            @else
                <a class="nav-link " href="/login" class="btn btn-info">
                    <span>Login</span>
                </a>
            @endif
            {{-- <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
        <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
      </a> --}}
        </li>
    </ul>
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
            <div class="dropdown-divider"></div>
            @if ($user != null && $user->role === 'Donatur')
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

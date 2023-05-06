<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" style="background-color: rgb(252, 84, 75);">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <ul class="navbar-nav ml-auto">
    <div class="topbar-divider d-none d-sm-block"></div>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle" src="@if($user->foto !== null) {{ asset('foto_user/'.$user->foto) }} @else {{ asset('foto_user/default.jpg') }} @endif" style="max-width: 60px">
        <span class="ml-2 d-none d-lg-inline text-white small">{{$user->nama}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
  </ul>
</nav>
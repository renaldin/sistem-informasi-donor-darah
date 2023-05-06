<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#" style="background-color: rgb(251, 62, 52);">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('template/img/logo/logo2.png') }}">
    </div>
    <div class="sidebar-brand-text mx-3">{{$data_web->nama_website}}</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item @if($title === 'Dashboard') active @endif">
    <a class="nav-link" href="/dashboard_admin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Data Master
  </div>
  <li class="nav-item @if($title === 'Data User') active @endif">
    <a class="nav-link" href="/data_user">
      <i class="fas fa-fw fa-palette"></i>
      <span>Data User</span>
    </a>
  </li>
  <hr class="sidebar-divider">
</ul>
<!-- Sidebar -->
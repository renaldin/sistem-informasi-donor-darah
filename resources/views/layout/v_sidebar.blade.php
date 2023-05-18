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
    <a class="nav-link" href="/dashboard">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  @if ($user->role === 'Admin')
    <div class="sidebar-heading">
      Data Master
    </div>
    <li class="nav-item @if($title === 'Data User') active @endif">
      <a class="nav-link" href="/data_user">
        <i class="fas fa-fw fa-palette"></i>
        <span>Data User</span>
      </a>
    </li>
    <li class="nav-item @if($title === 'Data Stok Darah') active @endif">
      <a class="nav-link" href="/data_stok_darah">
        <i class="fas fa-fw fa-palette"></i>
        <span>Data Stok Darah</span>
      </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Fitur
    </div>
    <li class="nav-item  @if($title === 'Pengajuan Event') active @endif">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengajuan_event"
        aria-expanded="true" aria-controls="pengajuan_event">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Data Pengajuan Event</span>
      </a>
      <div id="pengajuan_event" class="collapse @if($title === 'Pengajuan Event') show @endif" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Sub Menu</h6>
          <a class="collapse-item @if($sub_title === 'Data Pengajuan Event') active @endif" href="/data_pengajuan_event">Data Pengajuan</a>
          <a class="collapse-item @if($sub_title === 'Jadwal Event' || $sub_title === 'Tambah Event'|| $sub_title === 'Edit Event') active @endif" href="/jadwal_event">Jadwal Event</a>
          <a class="collapse-item  @if($sub_title === 'Riwayat Pengajuan Event') active @endif" href="/riwayat_pengajuan_event">Riwayat Pengajuan</a>
        </div>
      </div>
    </li>
  @elseif ($user->role === 'Donatur')
  @elseif ($user->role === 'Event')
  <div class="sidebar-heading">
    Event
  </div>
  <li class="nav-item @if($title === 'Pengajuan Event') active @endif">
    <a class="nav-link" href="/pengajuan_event">
      <i class="fas fa-fw fa-palette"></i>
      <span>Pengajuan Event</span>
    </a>
  </li>
  @elseif ($user->role === 'Petugas Kesehatan')
  @elseif ($user->role === 'Rumah Sakit')
  @elseif ($user->role === 'Pusat PMI')
    
  @endif
  <hr class="sidebar-divider">
</ul>
<!-- Sidebar -->
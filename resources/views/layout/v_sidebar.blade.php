<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#"
        style="background-color: rgb(251, 62, 52);">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('foto_biodata/logo-pmi.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ $data_web->nama_website }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    @if ($user->role !== 'Petugas Kesehatan')
    <li class="nav-item @if ($title === 'Dashboard') active @endif">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif
    <hr class="sidebar-divider">
    @if ($user->role === 'Admin')
        <div class="sidebar-heading">
            Data Master
        </div>
        <li class="nav-item @if ($title === 'Data User') active @endif">
            <a class="nav-link" href="/data_user">
                <i class="fas fa-fw fa-palette"></i>
                <span>Data User</span>
            </a>
        </li>
        <li class="nav-item @if ($title === 'Data Darah Masuk') active @endif">
            <a class="nav-link" href="/data_darah_masuk">
                <i class="fas fa-fw fa-palette"></i>
                <span>Data Darah Masuk</span>
            </a>
        </li>
        <li class="nav-item @if ($title === 'Data Stok Darah') active @endif">
            <a class="nav-link" href="/data_stok_darah">
                <i class="fas fa-fw fa-palette"></i>
                <span>Data Stok Darah</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Fitur
        </div>
        <li class="nav-item  @if ($title === 'Pengajuan Event') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengajuan_event"
                aria-expanded="true" aria-controls="pengajuan_event">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Data Pengajuan Event</span>
            </a>
            <div id="pengajuan_event" class="collapse @if ($title === 'Pengajuan Event') show @endif"
                aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub Menu</h6>
                    <a class="collapse-item @if ($sub_title === 'Data Pengajuan Event') active @endif"
                        href="/data_pengajuan_event">Data Pengajuan</a>
                    <a class="collapse-item @if (
                        $sub_title === 'Jadwal Event' ||
                            $sub_title === 'Detail Event' ||
                            $sub_title === 'Tambah Event' ||
                            $sub_title === 'Edit Event') active @endif" href="/jadwal_event">Jadwal
                        Event</a>
                    <a class="collapse-item  @if ($sub_title === 'Riwayat Pengajuan Event') active @endif"
                        href="/riwayat_pengajuan_event">Riwayat Pengajuan</a>
                </div>
            </div>
        </li>
        <li class="nav-item  @if ($title === 'Distribusi Darah') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#distribusi_darah"
                aria-expanded="true" aria-controls="distribusi_darah">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Distribusi Darah</span>
            </a>
            <div id="distribusi_darah" class="collapse @if ($title === 'Distribusi Darah') show @endif"
                aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub Menu</h6>
                    <a class="collapse-item @if ($sub_title === 'Data Distribusi Darah' || $sub_title === 'Form Keluarkan Darah') active @endif"
                        href="/distribusi_darah">Data Distribusi Darah</a>
                    <a class="collapse-item  @if ($sub_title === 'Riwayat Distribusi Darah') active @endif"
                        href="/riwayat_distribusi_darah">Riwayat Distribusi Darah</a>
                </div>
            </div>
        </li>
        <li class="nav-item @if ($title === 'Anggota') active @endif">
            <a class="nav-link" href="/anggota">
                <i class="fas fa-fw fa-palette"></i>
                <span>Anggota</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Laporan
        </div>
        <li class="nav-item @if ($sub_title === 'Laporan Darah Masuk') active @endif">
            <a class="nav-link" href="/laporan_darah_masuk">
                <i class="fas fa-fw fa-file"></i>
                <span>Darah Masuk</span>
            </a>
        </li>
        <li class="nav-item @if ($sub_title === 'Laporan Stok Darah') active @endif">
            <a class="nav-link" href="/laporan_stok_darah">
                <i class="fas fa-fw fa-file"></i>
                <span>Stok Darah</span>
            </a>
        </li>
        <li class="nav-item @if ($sub_title === 'Laporan Darah Keluar') active @endif">
            <a class="nav-link" href="/laporan_darah_keluar">
                <i class="fas fa-fw fa-file"></i>
                <span>Darah Keluar</span>
            </a>
        </li>
        <li class="nav-item @if ($sub_title === 'Laporan Darah Buang') active @endif">
            <a class="nav-link" href="/laporan_darah_buang">
                <i class="fas fa-fw fa-file"></i>
                <span>Darah Buang</span>
            </a>
        </li>
    @elseif ($user->role === 'Donatur')
        <div class="sidebar-heading">
            Donatur
        </div>
        <li class="nav-item @if ($title === 'Pengajuan Event') active @endif">
            <a class="nav-link" href="/daftar_donor">
                <i class="fas fa-fw fa-palette"></i>
                <span>Daftar Donor</span>
            </a>
        </li>
        <li class="nav-item @if ($title === 'Pengajuan Event') active @endif">
            <a class="nav-link" href="/riwayat_donor" id="#myBtn">
                <i class="fas fa-fw fa-palette"></i>
                <span>Riwayat Donor</span>
            </a>
        </li>
    @elseif ($user->role === 'Event')
        <div class="sidebar-heading">
            Event
        </div>
        <li class="nav-item @if ($title === 'Pengajuan Event') active @endif">
            <a class="nav-link" href="/pengajuan_event">
                <i class="fas fa-fw fa-palette"></i>
                <span>Pengajuan Event</span>
            </a>
        </li>
    @elseif ($user->role === 'Petugas Kesehatan')
        <div class="sidebar-heading">
            Petuags Kesehatan
        </div>
        <li class="nav-item @if ($title === 'Antrian') active @endif">
            <a class="nav-link" href="/antrian">
                <i class="fas fa-fw fa-palette"></i>
                <span>Antrian</span>
            </a>
        </li>
    @elseif ($user->role === 'Rumah Sakit')
        <div class="sidebar-heading">
            Rumah Sakit
        </div>
        <li class="nav-item @if ($title === 'Permohonan Darah') active @endif">
            <a class="nav-link" href="/permohonan_darah">
                <i class="fas fa-fw fa-palette"></i>
                <span>Permohonan Darah</span>
            </a>
        </li>
        <li class="nav-item @if ($title === 'Riwayat Permohonan Darah') active @endif">
            <a class="nav-link" href="/riwayat_permohonan_darah">
                <i class="fas fa-fw fa-palette"></i>
                <span>Rwiayat</span>
            </a>
        </li>
    @endif
    <hr class="sidebar-divider">
</ul>
<!-- Sidebar -->
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

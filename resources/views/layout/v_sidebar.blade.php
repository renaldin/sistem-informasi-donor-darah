<aside id="sidebar" class="sidebar">
  <div class="sidebar-img">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-heading">Dashboard</li>
    <li class="nav-item">
      <a class="nav-link {{ $subTitle === 'Dashboard' ? '':'collapsed'  }}" href="@if($user->role === 'Admin') /dashboardAdmin @elseif($user->role === 'Pegawai') /dashboardPegawai @elseif($user->role === 'Wakil Direktur') /dashboardWadir @elseif($user->role === 'Ketua Jurusan') /dashboardKajur @endif">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @if ($user->role === 'Admin')
    <li class="nav-heading">Master Data</li>
    <li class="nav-item">
      <a class="nav-link {{ $subTitle === 'Pengaturan Web' ? '':'collapsed'  }}" href="/pengaturan-web">
        <i class="bi bi-people"></i>
        <span>Pengaturan Web</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $subTitle === 'Users' ? '':'collapsed'  }}" href="">
        <i class="bi bi-people"></i>
        <span>Kelola User</span>
      </a>
    </li>
    @endif
  </ul>
</div>
</aside>
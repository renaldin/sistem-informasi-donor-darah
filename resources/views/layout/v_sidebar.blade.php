<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#" style="background-color: rgb(251, 62, 52);">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('template/img/logo/logo2.png') }}">
    </div>
    <div class="sidebar-brand-text mx-3">{{$data_web->nama_website}}</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Data Master
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
      aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-window-maximize"></i>
      <span>Bootstrap UI</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Bootstrap UI</h6>
        <a class="collapse-item" href="alerts.html">Alerts</a>
        <a class="collapse-item" href="buttons.html">Buttons</a>
        <a class="collapse-item" href="dropdowns.html">Dropdowns</a>
        <a class="collapse-item" href="modals.html">Modals</a>
        <a class="collapse-item" href="popovers.html">Popovers</a>
        <a class="collapse-item" href="progress-bar.html">Progress Bars</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="ui-colors.html">
      <i class="fas fa-fw fa-palette"></i>
      <span>UI Colors</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->
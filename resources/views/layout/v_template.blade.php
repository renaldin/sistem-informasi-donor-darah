
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('template/img/logo/logo.png') }}" rel="icon">
  <title>{{$sub_title}} - {{$data_web->nama_website}}</title>
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
  @include('sweetalert::alert')
  <div id="wrapper">
    
    {{-- sidebar --}}
    @include('layout.v_sidebar')
    {{-- tutup sidebar --}}

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('layout.v_topbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$sub_title}}</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">{{$title}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$sub_title}}</li>
            </ol>
          </div>

          {{-- Content --}}
          @yield('content')
          {{-- Tutp Content --}}


          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Logout</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah anda yakin akan logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                  <a href="/logout" class="btn btn-danger">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">Sistem Donor</a></b>
            </span>
          </div>
        </div>

      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>  
  <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('template/vendor/select2/dist/js/select2.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

<script>
  $(document).ready(function () {

    // Select2 Single  with Placeholder
    $('.select2-single-placeholder').select2({
      placeholder: "-- Pilih --",
      allowClear: true
    });      

    // Select2 Multiple
    $('.select2-multiple').select2();

  });
</script>
</body>

</html>
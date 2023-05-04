
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SI Donor | {{$title}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('layout')}}/assets/img/favicon.png" rel="icon">
  <link href="{{asset('layout')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('layout') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('layout') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/summernote/summernote-bs4.min.css">

  <!-- Template Main CSS File -->
  <link href="{{ asset('layout') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('layout') }}/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">SI SPP</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    @include('layout/v_nav')
    <!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('layout/v_sidebar')
  <!-- End Sidebar-->

  <!-- Default box -->
  @yield('content')
  <!-- /.card -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SI SPP</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="/">SI Donor</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('layout') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/chart.js/chart.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('layout') }}/assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('layout') }}/assets/js/main.js"></script>

  <!-- jQuery -->
  <script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('template')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('template')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('template')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('template')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Summernote -->
  <script src="{{ asset('template') }}/plugins/summernote/summernote-bs4.min.js"></script>
  
  <!-- Page specific script -->
  <script>
    $(function () {
      // Summernote
      $('#summernote').summernote()
    })
  </script>

  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>

</body>

</html>
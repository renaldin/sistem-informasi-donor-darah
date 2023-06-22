<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('foto_biodata/logo-pmi.png') }}" rel="icon">
    <title>{{ $sub_title }} - {{ $data_web->nama_website }}</title>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css') }}"
        rel="stylesheet">
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- aos js --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- custon css topbar nav --}}
    <style>
        @media (max-width: 575px) {
            .menu-nav {
                display: none;
            }

            .button-nav {
                display: block !important;
            }
        }
    </style>
</head>

<body id="page-top">
    @include('sweetalert::alert')
    <div id="wrapper">

        {{-- sidebar --}}
        {{-- @include('layout.v_sidebar') --}}
        {{-- tutup sidebar --}}

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include('layout.v_topbar_front')
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid pt-4" style="margin-top: -25px" id="container-wrapper">

                    {{-- Content --}}
                    @yield('content')
                    {{-- Tutp Content --}}


                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
                                    <button type="button" class="btn btn-outline-danger"
                                        data-dismiss="modal">Cancel</button>
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
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
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
    <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/vendor/clock-picker/clockpicker.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>
    {{-- aos js --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>

    <script>
        $(document).ready(function() {

            // Select2 Single  with Placeholder
            $('.select2-single-placeholder').select2({
                placeholder: "-- Pilih --",
                allowClear: true
            });

            // Select2 Multiple
            $('.select2-multiple').select2();

            $('#simple-date1 .input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true,
            });

            $('#clockPicker2').clockpicker({
                autoclose: true
            });

            $('#touchSpin1').TouchSpin({
                min: 0,
                max: 100,
                boostat: 5,
                maxboostedstep: 10,
                initval: 0
            });

        });
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>
